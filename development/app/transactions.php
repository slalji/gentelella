<script src="./app/js/transactions.js"></script>

<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div xclass="x_panel">
                  <div class="x_title ">
                    <h2>Selcom Utility Dashboard</h2>
                  
                    <div class="clearfix"></div>
                  </div>
                  <div  class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    <div id="loading"></div>
                      
                   </p>
                    <table id="dynamic-table" class="table table-striped table-bordered table-condensed">
                      <thead>
                        <tr>
                          
                         
                          <th>Days in Month</th>
                          <th>Utility</th>
                          <th>Total Tsh</th>
                          <th># of Transactions</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                  <div class="x_panel">
                  <div class="x_title">
                    <h2>Transaction Summary <small>Daily progress</small></h2>
                   
                  <div class="x_content">
                  
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <b>Total Amount (Tsh)</b>
                      <div class="demo-container" style="height:280px;">
                        <div id="placeholder" class="demo-placeholder"></div>
                      </div>
                      <b>Total Number of Transactions </b>
                      <div class="demo-container" style="height:280px;">
                        <div id="numbers"   class="demo-placeholder"></div>
                      </div> 


                  </div>
                
                </div>
                </div>
              </div>





          </div>
          <br />
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalLabel">Search</h3>
                <div class="message" id="message"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
            <div xclass="modal-body">

                <div class="col-xs-9 col-sm-6">
                  <form id="theForm">
                        <!--<div class="form-group">
                          <b>Date Range</b> <input type=checkbox name="check-date" id="check-date" >
                          <div id="reportrange"  style="border-radus:5px ;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; xwidth: 30%"> <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;<span id="date-text"></span> <b class="caret"></b></div>
                        </div>
                        -->
                        <div class="form-group col-xs-6 col-sm-6">
                          <label for="month">Month</label>
                          <select type="text" name="month" id="month" value="" class="form-control" >
                          <option selected>Choose...</option>
                              <option value="01">Jan</option>
                              <option value="02">Feb</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                          </select>
                        </div>
                        <div class="form-group col-xs-6 col-sm-6">
                          <label for="utility_code">Utility Code</label>
                          <select type="text" name="utility_code" id="utility_code" value="" class="form-control" >
                          <option value="">Loading ...</option>
                          </select>
                        </div>

                       <div class="clearfix"></div>
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
