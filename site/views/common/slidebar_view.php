<aside class="span3 left-sidebar" >
                    <div class="sidebar-item sidebar-filters" >

                        <!--  ==========  -->
                        <!--  = Sidebar Title =  -->
                        <!--  ==========  -->
                        <div class="underlined">
                        	<h3><span class="light">Lọc xe bạn cần</span> </h3>
                        </div>

                        <!--  ==========  -->
                        <!--  = Categories =  -->
                        <!--  ==========  -->
                        <div class="accordion-group" >
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" >Loại xe <b class="caret"></b></a>
                            </div>
                            <div  class="accordion-body collapse in">
                                <div class="accordion-inner">
								<?php 
								$category = get_categoty();
								foreach($category as $row){?>
                                    <a href="<?=$url_left?>&cate=<?=$row->lb_alias?>"  class="selectable"><i class="box"></i> <?php echo $row->lb_name;?></a>
								<?php }?>
									
                                </div>
                            </div>
                        </div> <!-- /categories -->

                        <!--  ==========  -->
                        <!--  = Prices slider =  -->
                        <!--  ==========  -->
                       <!-- <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" href="#filterPrices">Giá <b class="caret"></b></a>
                            </div>
                            <div class="accordion-body in collapse">
                                <div class="accordion-inner with-slider">
                                    <div class="jqueryui-slider-container">
                                        <div id="pricesRange"></div>
                                    </div>
                                    <input type="text" data-initial="432" class="max-val pull-right" disabled />
                                    <input type="text" data-initial="99" class="min-val" disabled />
                                </div>
                            </div>
                        </div>--> <!-- /prices slider -->

                        <!--  ==========  -->
                        <!--  = Size filter =  -->
                        <!--  ==========  -->
                        
                        <!--  ==========  -->
                        <!--  = Brand filter =  -->
                        <!--  ==========  -->
                      
                        

                    </div>
                </aside>