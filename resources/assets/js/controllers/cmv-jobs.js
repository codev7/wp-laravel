export default Vue.extend({

    ready() {
        window.getStep3 = (email) => {
            return 'Great job, ' + email + '.  In a perfect world, we would have finished this JS so that it sent us an email when you made it this far.  Unfortunately, we ran out of time.  As the first part of your job application, in less than 3 sentences, explain how you would make the getStep3() functional so that it sends me an email notification.  Email your answer to: connor@codemyviews.com.';
        }
    },

    methods: {
        step1: function(e) {
            e.preventDefault();
            alert("Welcome to step 1 of the Code My Views Inc. team member interview.  We are delighted to see you are interested in working with us.  To get to step 2 of the developer interview, please view your developer console in the browser.  If you don't know what that is then I bet google will be able to tell you!");
            console.log("Congrats!  You made it to step 2.  To get to step 3, run this JavaScript function in the developer console: getStep3(yourEmailHere)");
        }
    }

});