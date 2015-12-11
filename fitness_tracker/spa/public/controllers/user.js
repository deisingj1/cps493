        angular.module('app')
		.controller('user', function($http, panel){
		    var self = this;
			
			$http.get("/user")
			.success(function(data) {
				self.rows = data;
				$(".nav").children("li").removeClass("active");
				$("a[href='#/']").closest("li").addClass("active");
			});
			self.login = function(row) {
			    $http.post('/login/', row)
			      .success(function(data){
                    window.location = "#/meal";
                    window.location.reload();
			      }).error(function(data){
                    alert(data.code);
                });
			}
			self.signup = function(row) {
				$http.post('/user', row)
				.success(function(data){
					self.login(row);
				}).error(function(data){
					alert(data.code);
				});
			}
		})