var services = angular.module('quoreFunApp.services', ['ngResource']),
    controllers = angular.module('quoreFunApp.controllers', ['quoreFunApp.services'])
;

// Services

services.factory('Region', ['$resource', function ($resource) {
    return $resource('/region/:regionId')
}]);

// Controllers

controllers.controller('HomeController', function HomeController ($scope) {
    console.info('Im home')

})

controllers.controller('RegionListController', function ($scope, Region) {
    $scope.regions = Region.query()
})

controllers.controller('RegionController', function ($scope, Region, $stateParams) {
    $scope.region = Region.get({regionId:$stateParams.regionId})
})

controllers.controller('RegionEditController', function ($scope, Region, $stateParams, $state) {
    $scope.region = Region.get({regionId:$stateParams.regionId})

    $scope.cancel = function () {
        $state.go('regionList')
    }

    $scope.save = function () {
        $scope.region.$save({regionId:$stateParams.regionId}, function () {
            $state.go('regionList')
        })
    }
})

controllers.controller('RegionCreateController', function ($scope, Region, $stateParams, $state) {
    $scope.region = new Region()

    $scope.cancel = function () {
        $state.go('regionList')
    }

    $scope.save = function () {
        $scope.region.$save({}, function () {
            $state.go('regionList')
        })
    }
})

controllers.controller('RegionDeleteController', function ($scope, Region, $stateParams, $state) {
    $scope.region = Region.get({regionId:$stateParams.regionId})

    $scope.cancel = function () {
        $state.go('regionList')
    }

    $scope.delete = function () {
        $scope.region.$delete({regionId:$stateParams.regionId}, function () {
            $state.go('regionList')
        })
    }
})

// Load up the app

var app = angular.module('quoreFunApp', [
    'ui.router',
    'quoreFunApp.services',
    'quoreFunApp.controllers'
]);

// Configure Routing

app.config(['$stateProvider', function ($stateProvider) {
    $stateProvider
        .state('home', {
            url: '',
            templateUrl: '/app/partials/homepage.html',
            controller: 'HomeController'
        })
        .state('regionList', {
            url: '/regions',
            templateUrl: '/app/partials/region/list.html',
            controller: 'RegionListController'
        })
        .state('region', {
            url: '/region/:regionId/detail',
            templateUrl: '/app/partials/region/detail.html',
            controller: 'RegionController'
        })
        .state('regionCreate', {
            url: '/region/create',
            templateUrl: '/app/partials/region/edit.html',
            controller: 'RegionCreateController'
        })
        .state('regionEdit', {
            url: '/region/:regionId/edit',
            templateUrl: '/app/partials/region/edit.html',
            controller: 'RegionEditController'
        })
        .state('regionDelete', {
            url: '/region/:regionId/delete',
            templateUrl: '/app/partials/region/delete.html',
            controller: 'RegionDeleteController'
        })
    ;
}]);
