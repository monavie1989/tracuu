<?php

/*
 * @author Quyet2n
 */
Yii::import('zii.widgets.grid.CGridView');

class CGridViewEx extends CGridView {

    //array page size want show, if not array will hidden
    public $pageSizeChange = array('10', '25', '50', '100');
    //string, if empty will hidden
    public $field_search = '';

    public function init() {
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
            unset($_GET['pageSize']); // would interfere with pager and repetitive page size change
        }
        if (Yii::app()->user->getState('pageSize')) {
            $this->dataProvider->pagination->pageSize = Yii::app()->user->getState('pageSize');
        }
        $this->template = '<div id="dt_gal_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row">
                <div class="span6">
                    <div class="dt_actions">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)" class="delete_rows_dt" onclick="fdelete(event);" data-tableid="dt_gal"><i class="icon-trash"></i> Delete</a></li>
                            </ul>
                        </div>
                    </div>';
        if (is_array($this->pageSizeChange) && !empty($this->pageSizeChange)) {
            $this->template .= '
                    <div class="dataTables_length" id="dt_gal_length">
                        <label>Show
                        <select class="pageSizeChange" aria-controls="dt_gal" size="1" name="dt_gal_length">';
            foreach ($this->pageSizeChange as $pageSize) {
                if ($pageSize == $this->dataProvider->pagination->pageSize) {
                    $this->template .= '<option selected="selected" value="' . $pageSize . '">' . $pageSize . '</option>';
                } else {
                    $this->template .= '<option value="' . $pageSize . '">' . $pageSize . '</option>';
                }
            }
            $this->template .= '
                        </select>
                        entries</label>
                    </div>';
        }
        $this->template .= '
                </div>';
        if (!empty($this->field_search)) {
            $this->template .= '
            <div class="span6">
                <form method="get" action="" id="form_search">
                    <div id="dt_gal_filter" class="dataTables_filter">
                        <label>Search:
                            ' . CHtml::activeTextField($this->dataProvider->model, $this->field_search) . '
                        </label>
                    </div>
                </form>
            </div>';
        }
        $this->template .= '
            </div>
            {items}
            <div class="row">
                <div class="span6">
                    <div id="dt_gal_info" class="dataTables_info">
                        {summary}
                    </div>
                </div>
                <div class="span6">
                    <div id="dt_gal_info" class="dataTables_info">
                        {pager}
                    </div>
                </div>
            </div>
            
        </div>';

        $tmp = array();
        $tmp[] = array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => $pageSize,
            'header' => '<input type="checkbox" name="select_all_rows" class="select_rows" data-tableid="dt_gal">',
            'value' => '$data->' . Common::getKeyNameOfTable($this->dataProvider->model)
        );
        foreach ($this->columns as $key => $col) {
            if (isset($col['class'])) {
                if ($col['class'] == 'CButtonColumn' && !isset($col['header'])) {
                    $col['header'] = 'Actions';
                }
                if ($col['class'] == 'CButtonColumn' && !isset($col['buttons']['view']['imageUrl'])) {
                    $col['buttons']['view']['imageUrl'] = Yii::app()->baseUrl . '/theme_admin/img/ico/view_off.png';
                }
                if ($col['class'] == 'CButtonColumn' && !isset($col['buttons']['delete']['imageUrl'])) {
                    $col['buttons']['delete']['imageUrl'] = Yii::app()->baseUrl . '/theme_admin/img/ico/delete_off.png';
                }
                if ($col['class'] == 'CButtonColumn' && !isset($col['buttons']['update']['imageUrl'])) {
                    $col['buttons']['update']['imageUrl'] = Yii::app()->baseUrl . '/theme_admin/img/ico/update_off.png';
                }
            }else{	
				if(is_array($col) && isset($col['htmlOptions']['class']) && isset($col['name'])){
					$col['htmlOptions']['class'] .= ' col_'.$col['name'];
				}elseif(is_string($col)){
					$col = array(
						'name' =>  $col,
						'htmlOptions' => array(
							'class' => 'col_'.$col
						)
					);
				}
			}
            $tmp[] = $col;
        }
        $this->columns = $tmp;
        $pager_param_default = array(
            'header' => '',
            'firstPageLabel' => '',
            'lastPageLabel' => '',
            'prevPageLabel' => '< Previous',
            'nextPageLabel' => 'Next >',
            'hiddenPageCssClass' => 'disabled',
            'previousPageCssClass' => 'prev',
            'nextPageCssClass' => 'next',
            'selectedPageCssClass' => 'active',
            'htmlOptions' => array(
                'class' => ''
            )
        );

        $this->pager = array_merge($pager_param_default, $this->pager);
        $this->pagerCssClass = 'dataTables_paginate paging_bootstrap pagination';
        $this->filter = null;
        if (!isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] = 'grid-view-custom';
        else
            $this->htmlOptions['class'] = $this->htmlOptions['class'] . ' grid-view-custom';

        parent::init();
    }

    /**
     * Renders the data items for the grid view.
     */
    public function renderItems() {
        $client_script = '
            <script type="text/javascript">
             $(document).ready(function(){
                reinstallGridView();
            })
            function fdelete(event){
                if(!confirm("Are you sure you want to delete this items?")) return false;
                    var checkItems = [];
                    $(event.target).parents("div.grid-view-custom").find("td.checkbox-column input:checked").map(function()
                    {
                        checkItems.push($(this).val());
                    });
                    var th = this,
                    afterDelete = function(){};
                    jQuery("#' . $this->id . '").yiiGridView("update", {
                        type: "POST",
                        data:{items:checkItems,action:"delete"},
                        success: function(data) {
                        jQuery("#' . $this->id . '").yiiGridView("update");
                    afterDelete(th, true, data);
                    },
                    error: function(XHR) {
                        return afterDelete(th, false, XHR);
                    }
                });
                return false;
            }
            function reinstallGridView(id, data) {
                $(".grid-view-custom .select_rows").change(function(){
                    if($(this).is(\':checked\')){
                        $(this).parents("div.grid-view-custom").find("td.checkbox-column input[type=checkbox]").prop("checked", true);
                    }else{
                        $(this).parents("div.grid-view-custom").find("td.checkbox-column input[type=checkbox]").prop("checked", false);
                    }
                })
                $(".pageSizeChange").change(function(){
                    $("#' . $this->id . '").yiiGridView("update", {
                        data:{pageSize: $(this).val() }
                    });
                    return false;
                });
                var tags = ["img","input"];
                for( var i=0, len=tags.length; i<len; i++ ) {
                    var on = function() {
                        this.src = this.src.replace("_off.", "_on.");
                    };
                    var off  = function() {
                        this.src = this.src.replace("_on.", "_off.");
                    };
                    var el = document.getElementsByTagName(tags[i]);
                    for (var j=0, len2=el.length; j<len2; j++) {
                        var attr = el[j].getAttribute("src");
                        if (!el[j].src.match(/_off\./)&&attr) continue;
                        el[j].onmouseover = on;
                        el[j].onmouseout  = off;
                    }
                }
                
                /* define action List */
                $(document).ready(function() {';

        if (empty($this->pager['firstPageLabel'])) {
            $client_script .= '$( ".pagination li.first" ).remove();';
        }
        if (empty($this->pager['lastPageLabel'])) {
            $client_script .= '$( ".pagination li.last" ).remove();';
        }
        $client_script .= '
                });
            }
            </script>';
        echo $client_script;
        if ($this->dataProvider->getItemCount() > 0 || $this->showTableOnEmpty) {
            echo "<table id=\"dt_gal\" class=\"table table-bordered table-striped table_vam {$this->itemsCssClass}\">\n";
            $this->renderTableHeader();
            ob_start();
            $this->renderTableBody();
            $body = ob_get_clean();
            $this->renderTableFooter();
            echo $body; // TFOOT must appear before TBODY according to the standard.
            echo "</table>";
        } else
            $this->renderEmptyText();
    }

}
