<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div xclass="x_panel">
                  <div class="x_title ">
                    <h2>NBC Agency Transactions</h2>
                    <!--<ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <ul>
                    <div class="pull-right tableTools-container">
                      <div class="dt-buttons btn-overlap btn-group">
                        <a class="dt-button buttons-collection buttons-colvis btn btn-white 
                        btn-default btn-bold" tabindex="0" aria-controls="dynamic-table" data-original-title="" 
                        title=""><span><i class="fa fa-eye-slash bigger-110 blue"></i> 
                        <span class="hidden">Show/hide columns</span></span></a>
                        <a class="dt-button buttons-copy buttons-html5 btn btn-white btn-default btn-bold" 
                        tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span>
                          <i class="fa fa-copy bigger-110 pink"></i> <span class="hidden">Copy to clipboard

                          </span></span></a><a class="dt-button buttons-csv buttons-html5 btn btn-white 
                          btn-default btn-bold" tabindex="0" aria-controls="dynamic-table" 
                          data-original-title="" title=""><span><i class="fa fa-file-excel-o bigger-110 green">

                          </i> <span class="hidden">Export to CSV</span></span
                          a><a class="dt-button buttons-print btn btn-white btn-default btn-bold"
                           tabindex="0" aria-controls="dynamic-table" data-original-title="" title=""><span>
                             <i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></span></a></div></div>
                    </ul> -->
                    <div class="clearfix"></div>
                  </div>
                  <div xclass="x_content">
                    <p class="text-muted font-13 m-b-30">
                    <div id="loading"></div>
                      
                   </p>
                    <table id="dynamic-table" class="table table-striped table-bordered table-condensed">
                      <thead>
                        <tr>
                          <th>ID </i></th>
                          <th>Date </i></th>
                          <th>Terminal </i></th>
                          <th>Member Name </i></th>
                          <th>Address</th>
                          <th>Utility Type </i></th> 
                          <th>Amount </i></th>                        
                          <th>Utility Reference </i></th>
                          <th>Phone </i></th>
                          <th>Reference </i></th>
                          <th>TransID </i></th>
                          <th>Result </i></th>
                          <th xclass="hidden">Message</th>
                          
                         
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


                    
					
                  </div>
                </div>
              </div>
            </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Advanced Search</h5>
                <div class="message" id="message"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
            <div xclass="modal-body">

                <div class="col-xs-12 col-sm-6">
                  <form id="theForm">
                        <div class="form-group">
                          <b>Date Range</b> <input type=checkbox name="check-date" id="check-date" >
                          <div id="reportrange"  style="border-radus:5px ;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; xwidth: 30%"> <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;<span id="date-text"></span> <b class="caret"></b></div>
                        </div>
                        <div class="form-group">
                          <label for="transid">Reference / Transaction ID</label>
                          <input type="text" name="transid" id="transid" value="" class="form-control" />
                        </div>
                        <div class="form-group">
                          <label for="utility_ref">Utility Reference</label>
                          <input type=text name="utility_ref" id="utility_ref" value="" class="form-control"  />
                        </div>
                        <!--<div class="form-group">
                          <label for="result">Result</label>
                          <select type=text name="result" id="result" class="form-control" >
                              <option value="">All</option>
                              <option value="000">Success</option>
                          </select>
                        </div>-->
                        
                        
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Result</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="isresult" class="btn-group" data-toggle="buttons">
                              <label class="btn btn-default" data-toggle-class="btn btn-primary" xdata-toggle-passive-class="btn-default">
                                <input type="radio" id="result" name="result" value="000"> Success
                              </label>
                              <label class="btn btn-default active" data-toggle-class="btn btn-primary" xdata-toggle-passive-class="btn-default">
                                <input type="radio" id="result" name="result" checked value=""> All
                              </label>
                            </div>
                          </div>
                        </div>
<br><br><br>
<div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Download</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="isdownload" class="btn-group" data-toggle="buttons">
                              <label class="btn btn-default" data-toggle-class="btn btn-primary" xdata-toggle-passive-class="btn-default">
                                <input type="radio" id="download" name="download" value="yes"> &nbsp; Yes &nbsp;
                              </label>
                              <label class="btn btn-default active" data-toggle-class="btn btn-primary" xdata-toggle-passive-class="btn-default">
                                <input type="radio" id="download" name="download" checked value="no"> No
                              </label>
                            </div>
                          </div>
                        </div>
                </form>

              </div>
                
            </div>
            <div class="modal-footer">               
                <button type="button" class="btn btn-primary" id="save" value="save" name="submit">Search</button>
                <!--<button type="button" class="btn btn-warning" id="download" value="download" name="download">Download</button>-->
                <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
 
  <!-- end modal-->
