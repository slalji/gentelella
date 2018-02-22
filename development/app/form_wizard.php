
        <!-- page content -->
        <div class="row">

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Employment <small>Intake Form</small></h2>
      <ul class="nav navbar-right panel_toolbox">
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
      <div class="clearfix"></div>
    </div>
    <div class="x_content">


      <!-- Smart Wizard -->
      <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
      <div id="wizard" class="form_wizard wizard_horizontal">
        <ul class="wizard_steps">
          <li>
            <a href="#step-1">
              <span class="step_no">1</span>
              <span class="step_descr">
                               
                                <small>Personal</small>
                            </span>
            </a>
          </li>
          <li>
            <a href="#step-2">
              <span class="step_no">2</span>
              <span class="step_descr">
                               
                                <small>Contact</small>
                            </span>
            </a>
          </li>
          <li>
            <a href="#step-3">
              <span class="step_no">3</span>
              <span class="step_descr">
                               
                                <small>Next of Kin</small>
                            </span>
            </a>
          </li>
          <li>
            <a href="#step-4">
              <span class="step_no">4</span>
              <span class="step_descr">
                               
                                <small>Employment</small>
                            </span>
            </a>
          </li>
        </ul>
        <div id="step-1">
        <h2 class="StepTitle">Step 1 Personal</h2>
          <form class="form-horizontal form-label-left" data-persist="garlic">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Full Name <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="fullname" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="age">Age <span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-2 col-xs-3">
                <input type="text" id="age" name="age" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label for="designation" class="control-label col-md-3 col-sm-3 col-xs-12">Designation</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="designation" class="form-control col-md-7 col-xs-12" name="designation">
                  <option value="">--Choose--</option>
                  <option value="manager">MANAGER</option>
                  <option value="supervisor">SUPERVISOR</option>
                  <option value="technician">TECHNICIAN</option>
                  <option value="forman">FOREMAN</option>
                  <option value="engineer">ENGINEER</option>
                  <option value="skilled_labour">SKILLED LABOURER</option>
                  <option value="unskilled_labour">UNSKILLED LABOURER</option>

                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div id="gender" class="btn-group" data-toggle="buttons">
                  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
                  </label>
                  <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="gender" value="female"> Female
                  </label>
                </div>
              </div>
            </div>
            

          </form>

        </div>
        <div id="step-2">
          <h2 class="StepTitle">Step 2 Contact</h2>
          
          <form class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="address" required="required" class="form-control col-md-7 col-xs-12" placeholder="street, area, city">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="email" name="email" required="required" placeholder="your@emailaddress2018.com" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label for="phone" class="control-label col-md-3 col-sm-3 col-xs-10">Phone<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="phone" class="form-control col-md-7 col-xs-12" type="text" name="phone" require data-mask="+255 000 000 000"  placeholder="+255 000 000 000">
              </div>
            </div>
            <div class="form-group">
              <label for="phone2" class="control-label col-md-3 col-sm-3 col-xs-10">Phone2</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="phone2" class="form-control col-md-7 col-xs-12" type="text" name="phone2"data-mask="+255 000 000 000"  placeholder="+255 000 000 000">
              </div>
            </div>

            </form>                         
          
        </div>
        <div id="step-3">
          <h2 class="StepTitle">Step 3 Relation Details</h2>
           <form class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Contact Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="contact_name"  name="contact_name" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="age">Contact Relationship <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="contact_relation" name="contact_relation"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label for="contact_phone" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Phone</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="contact_phone" class="form-control col-md-7 col-xs-12" type="text" name="contact_phone" placeholder="+255 000 000 000"  data-mask="+255 000 000 000">
                </div>
              </div>
              

              </form>
           
        </div>
        <div id="step-4">
          <h2 class="StepTitle">Step 4 Employment</h2>
          <form class="form-horizontal form-label-left">

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nssf">NSSF No. <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nssf"  class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emp_start">Employment Start Date <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="emp_start" name="emp_start" class="date-picker form-control col-md-7 col-xs-12" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="emp_end" class="control-label col-md-3 col-sm-3 col-xs-12">Employment End Date</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="emp_end" class="date-picker form-control col-md-7 col-xs-12" type="text" name="emp_end">
                  </div>
                </div>
                
                <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Terms of Employment</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div id="emp_terms" class="btn-group" data-toggle="buttons">
                  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="emp_terms" value="permnent"> &nbsp; Permnent &nbsp;
                  </label>
                  <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="emp_terms" value="temporary"> Temporary / Contract
                  </label>
                </div>
              </div>
            </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contract_period">Employment Contract Period</label>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <select  id="contract_period" name="contract_period"  class="form-control col-md-7 col-xs-12">
                    <option value="">--Choose--</option>
                      <option value="days">Days (1-30)</option>
                      <option value="weeks">Weeks (1-4)</option>
                      <option value="days">Months (1-12)</option>
                      <option value="days">Yearly (1)</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gross">Gross Salary</label>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="gross"  class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extension">Extention of Contract Period</label>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select  id="extension"  class="form-control col-md-7 col-xs-12">
                    <option value="">--Choose--</option>
                      <option value="days">Days (1-30)</option>
                      <option value="weeks">Weeks (1-4)</option>
                      <option value="days">Months (1-12)</option>
                      <option value="days">Yearly (1)</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emp_by">Employed By</label>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="emp_by"  class="form-control col-md-7 col-xs-12">
                      <option value="">--Choose--</option>
                      <option value="director">Director</option>
                      <option value="technical Manager">Technical Manager</option>
                      <option value="HR Manger">HR Manager</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="approved_by">Approved By</label>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="approved_by"  class="form-control col-md-7 col-xs-12">
                      <option value="">--Choose--</option>
                      <option value="director">Director</option>
                      <option value="technical Manager">Technical Manager</option>
                      <option value="HR Manger">HR Manager</option>
                    </select>
                  </div>
                </div>
                </form>
          
        </div>

      </div>
      <!-- End SmartWizard Content -->





      
      <!-- End SmartWizard Content -->
    </div>
  </div>
</div>
</div>
        <!-- /page content -->

