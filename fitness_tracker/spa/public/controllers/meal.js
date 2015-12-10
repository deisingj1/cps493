        angular.module('app')
		.controller('meal', function($http, panel){
			var self = this;
	
			$http.get("/meal")
			.success(function(data) {
				self.rows = data;
				$(".nav").children("li").removeClass("active");
				$("a[href='#/meal']").closest("li").addClass("active");
			});
			self.create = function() {
				self.rows.push({ isEditing: true });	
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
				panel.show({
					title: "Confirm delete",
					body: "Are you sure you want to delete " + row.meal + "?",
					confirm: function() {
						$http.delete('/meal/' + row.id)
						.success(function(data) {
							self.rows.splice(index,1);
							panel.show(false);
						}).error(function(data) {
							alert(data.code);
						});
					}					
				});
			}
		})
		.controller('mealSearch', function($http, panel){
            var self = this;
            
            self.row = {};
            self.term = null;
            self.choices = [];
            
            self.search = function(){
            	if(self.term != "") {
                	$http.get("/meal/search/" + self.term)
                	.success(function(data){
                	    self.choices = data.hits;
            		});
            	}
            	else {
            		self.choices = [];
            	}
            }
            self.choose = function(choice){
                self.row.Name = choice.fields.item_name;
                self.row.Calories = choice.fields.nf_calories;
                self.row.Fat = choice.fields.nf_total_fat;
                self.choices = [];
            }
        })