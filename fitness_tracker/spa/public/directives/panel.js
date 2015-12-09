angular.module('deisingj1.directives', [])
    .directive('mpPanel', function () {
        return {
            restrict: 'EA',        
            controller: function(panel, $scope){
                $scope.vm = panel;
            },
            templateUrl: 'directives/panel.html'
        }
    })
    .service('panel', function(){
        var self = this;
        self.state = null;
        self.show = function(state){
            self.state = state;
        }
})