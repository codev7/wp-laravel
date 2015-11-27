Vue.component('spark-team-settings-screen', {
    /*
     * Bootstrap the component. Load the initial data.
     */
	ready: function () {
        this.getUsersAccess();
		this.getTeam();
		this.getRoles();
	},


    /*
     * Initial state of the component's data.
     */
	data: function () {
		return {
            team: null
        };
	},


	events: {
	    /*
	     * Handle the "updateTeam" event. Re-retrieve the team.
	     */
		updateTeam: function () {
			this.getTeam();
            this.getUsersAccess();

			return true;
		}
	},


	methods: {
	    /*
	     * Get the team from the API.
	     */
		getTeam: function () {
            this.$http.get('/spark/api/teams/' + TEAM_ID)
                .success(function (team) {
                	this.team = team;

                	this.$broadcast('teamRetrieved', team);
                });
		},

        getUsersAccess() {
            this.$http.get(`/api/teams/${TEAM_ID}/users_access`)
                .success((data) => {
                    this.access = data.data;

                    this.$broadcast('usersAccessRetrieved', this.access);
                });
        },

		/**
		 * Get all of the roles that may be assigned to users.
		 */
		getRoles: function () {
			this.$http.get('/spark/api/teams/roles')
				.success(function (roles) {
					this.roles = roles;

					this.$broadcast('rolesRetrieved', roles);
				});
		}
	}
});
