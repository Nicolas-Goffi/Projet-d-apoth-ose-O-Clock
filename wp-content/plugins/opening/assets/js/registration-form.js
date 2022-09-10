const registrationForm = {
      
    init: function() {
       
        const roleSelectElement = document.querySelector('#user_role');
      
        roleSelectElement.addEventListener('change', registrationForm.onRoleChange);
 
        registrationForm.bandnameFieldContainer = document.querySelector('#user_bandname').closest('p');

        registrationForm.bandnameFieldContainer.style.display = "none";
    },

    onRoleChange: function(event) {    
        
        const selectedRole = event.currentTarget.value;
        
        if (selectedRole === 'band') {
            registrationForm.bandnameFieldContainer.style.display = 'block';
        } else {            
            registrationForm.bandnameFieldContainer.style.display = "none";
        }
    }
}

document.addEventListener('DOMContentLoaded', registrationForm.init);
