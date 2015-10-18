if(document.querySelector('#quote-form'))
{
    new Vue({
        el: '#quote-form',

        data: {
            newQuote: {
                project_type: '',
                lead_deadline: '',
                project_brief: '',
                files: [],
                name: '',
                email: '',
                phone: ''
            },
            submitted: false,
            step: 1,
            h3_header: 'Start Here',
            triedToSubmit: false
        },

        computed: {
            errors: function() {
                for (var key in this.newMessage) {
                    if ( ! this.newMessage[key]) return true;
                }

                return false;
            },
            fileCount: function() {


                return this.newQuote.files.length;

            }
        },

        ready: function() {
            CMV.trackEvent('lead','Lead Form Viewed',0);
        },

        methods: {
            onSubmitForm: function(e) {
                e.preventDefault();

                var that = this;

                that.triedToSubmit = true;

                if(that.newQuote.email == '' || that.newQuote.name == '') return false;

                var quote = that.newQuote;
                that.submitted = true;

                that.$http.post('quote/new', quote, function(data, status, request) {

                    that.h3_header = 'Success!';
                    that.gotoStep(3);

                    CMV.trackEvent('lead','Lead Submitted',0);

                    _pq.push(['track', 'warm_lead']);
                    
                }).error(function(data, status, request){

                    that.submitted = false;
                    for(var key in data) {

                        alert(data[key]); 

                    }
                   

                });
            },
            hasError: function(field) {
                
                if(this.triedToSubmit === false) return false;

                if(this.newQuote[field] === ''){                
                
                    return true;

                }


                return false;
            },

            launchFilePicker: function(e) {

                var that = this;
                e.preventDefault();

                CMV.trackEvent('lead','File Picker Clicked',0);

                filepicker.setKey("AddRqwmZQ7abQl0gUsXJwz");
                filepicker.pickMultiple(
                {
                    services: ['COMPUTER', 'DROPBOX', 'BOX', 'GOOGLE_DRIVE', 'WEBCAM'], 
                },
                function(Blobs){
                
                    CMV.trackEvent('lead','Files Uploaded',0);
                    for(i=0; i < Blobs.length; i++)
                    {

                        that.newQuote.files.push(Blobs[i].url);
        
                    }
                });
            },

            gotoStep: function(step, e) {

                if(e)
                {
                    e.preventDefault();    
                }
                

                $.scrollTo('#quote-form',{

                    duration: 500,
                    offset: {
                        top: 110
                    }

                });
             
                this.step = step;

                if(step == 2)
                {   
                    CMV.trackEvent('lead','Step 1 Submitted',0);
                    this.h3_header = 'Your Information';
                }

                if(step == 1)
                {   
                    CMV.trackEvent('lead','Back Button Clicked',0);
                    this.h3_header = 'Start Here';

                    setTimeout(function()
                    {

                        customForm.customForms.replaceAll();

                    },10);
                }
            },

            isStep: function(steps) {

                if(steps.indexOf(this.step) > -1) return true;


                return false;
            }   
        }
    });    
}
