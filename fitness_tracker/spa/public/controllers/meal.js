        angular.module('app')
		.controller('meal', function($http){
			var self = this;
			
			$http.get("/meal")
			.success(function(data) {
				self.rows = data;
				$(".nav").children("li").removeClass("active");
				$("a[href='#/meal']").closest("li").addClass("active");
			});
			self.create = function() {
				self.rows.push({ isEditing: true});
			}
			self.edit = function(row, index){
				row.isEditing = true;	
			}
			self.save = function(row, index) {
				$http.post('/meal/', row)
                    .success(function(data){
                    	data.isEditing = false;
                    	self.rows[index] = data;
                    }).error(function(data){
                        alert(data.code);
                    });
			}
			self.delete = function(row, index) {
				self.d = {
					title: "Confirm delete",
					body: "Are you sure you want to delete " + row.meal + "?",
					confirm: function() {
						$http.delete('/meal/' + row.id)
						.success(function(data) {
							self.rows.splice(index,1);
							$("#deleteModal").modal('hide');
						}).error(function(data) {
							alert(data.code);
						});
					}					
				}
				$("#deleteModal").modal('show');
			}
		})