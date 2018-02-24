  /* SMART WIZARD */
		
  function init_SmartWizard() {
			
    if( typeof ($.fn.smartWizard) === 'undefined'){ alert('Err: smartWizard');return; }
    console.log('init_SmartWizard');
    
    /*$('#wizard').smartWizard({
        transitionEffect: 'slide',
        enableFinishButton: false,
        onShowStep: true,
    });*/
        // Smart Wizard         
            $('#wizard').smartWizard({
                onLeaveStep:leaveAStepCallback,
                onFinish:onFinishCallback,
                labelFinish:'Save',
        });
        $('.buttonFinish').hide();
        
        function leaveAStepCallback(obj, context){
                //alert("Leaving step " + context.fromStep + " to go to step " + context.toStep);
                if (context.fromStep != 3){							
                    $('.buttonFinish').hide();
                    return true;

                }
            
                else{
                    //alert("Leaving step " + context.fromStep + " to go to step " + context.toStep);
                    //$('.buttonFinish').css('display','block');
                    $('.buttonFinish').show();
                    return true;
                }
            
                //return validateSteps(context.fromStep); // return false to stay on step and true to continue navigation 
        }

        function onFinishCallback(objs, context){
            $.ajax({
                type:"POST",
                url:"ajax/addEmp.php",
                data:$('form').serialize(),
                success: function(response){
                    console.log(response);  
                }
            });
        }

    $('#wizard_verticle').smartWizard({
      transitionEffect: 'slide'
    });

    
    $('.buttonPrevious').addClass('btn btn-primary');
    $('.buttonNext').addClass('btn btn-success');
    $('.buttonFinish').addClass('btn btn-warning');

    $("#wizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
        alert("You are on step "+stepNumber+" now");
 });

};
