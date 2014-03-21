var services = angular.module('quoreFunApp.services', ['ngResource']),
    controllers = angular.module('quoreFunApp.controllers', ['quoreFunApp.services'])
;

// Services

services.factory('Region', ['$resource', function ($resource) {
    return $resource('/region/:regionId')
}]);

services.factory('Property', ['$resource', function ($resource) {
    return $resource('/property/:regionId/:propertyId')
}]);

// Controllers

controllers.controller('HomeController', function HomeController ($scope) {})

controllers.controller('RegionListController', function ($scope, Region) {
    $scope.regions = Region.query()
})

controllers.controller('RegionController', function ($scope, Region, $stateParams, Property) {
    var regionId = $stateParams.regionId

    $scope.region = Region.get({regionId:regionId})
    $scope.properties = Property.query({regionId:$stateParams.regionId})
})

controllers.controller('RegionEditController', function ($scope, Region, $stateParams, $state) {
    $scope.region = Region.get({regionId:$stateParams.regionId})

    $scope.cancel = function () {
        window.history.back();
    }

    $scope.save = function () {
        $scope.region.$save({regionId:$stateParams.regionId}, function () {
            $state.go('region', {regionId:$stateParams.regionId})
        })
    }
})

controllers.controller('RegionCreateController', function ($scope, Region, $stateParams, $state) {
    $scope.region = new Region()

    $scope.cancel = function () {
        window.history.back();
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
        window.history.back();
    }

    $scope.delete = function () {
        $scope.region.$delete({regionId:$stateParams.regionId}, function () {
            $state.go('regionList')
        })
    }
})

controllers.controller('PropertyListController', function ($scope, Property) {
    $scope.properties = Property.query()
})

controllers.controller('PropertyController', function ($scope, Property, $stateParams) {
    $scope.regionId = $stateParams.regionId
    $scope.property = Property.get({regionId:$stateParams.regionId, propertyId:$stateParams.propertyId})
})

controllers.controller('PropertyEditController', function ($scope, Property, $stateParams, $state) {
    var regionId = $stateParams.regionId,
        propertyId = $stateParams.propertyId
    ;

    $scope.property = Property.get({regionId:regionId, propertyId:propertyId})

    $scope.cancel = function () {
        window.history.back();
    }

    $scope.save = function () {
        $scope.property.$save({regionId:regionId, propertyId:propertyId}, function () {
            $state.go('region', {regionId:regionId})
        })
    }
})

controllers.controller('PropertyCreateController', function ($scope, Property, $stateParams, $state, Region) {
    $scope.property = new Property()
    $scope.region = Region.get({regionId:$stateParams.regionId})

    $scope.cancel = function () {
        window.history.back();
    }

    $scope.save = function () {
        $scope.property.$save({regionId:$stateParams.regionId}, function () {
            $state.go('region', {regionId:$stateParams.regionId})
        })
    }
})

controllers.controller('PropertyDeleteController', function ($scope, Property, $stateParams, $state) {
    $scope.property = Property.get({regionId:$stateParams.regionId, propertyId:$stateParams.propertyId})

    $scope.cancel = function () {
        window.history.back();
    }

    $scope.delete = function () {
        $scope.property.$delete({regionId:$stateParams.regionId, propertyId:$stateParams.propertyId}, function () {
            $state.go('region', {regionId:$stateParams.regionId})
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
        .state('propertyList', {
            url: '/properties',
            templateUrl: '/app/partials/property/list.html',
            controller: 'PropertyListController'
        })
        .state('property', {
            url: '/property/:regionId/:propertyId/detail',
            templateUrl: '/app/partials/property/detail.html',
            controller: 'PropertyController'
        })
        .state('propertyCreate', {
            url: '/property/:regionId/:propertyId/create',
            templateUrl: '/app/partials/property/edit.html',
            controller: 'PropertyCreateController'
        })
        .state('propertyEdit', {
            url: '/property/:regionId/:propertyId/edit',
            templateUrl: '/app/partials/property/edit.html',
            controller: 'PropertyEditController'
        })
        .state('propertyDelete', {
            url: '/property/:regionId/:propertyId/delete',
            templateUrl: '/app/partials/property/delete.html',
            controller: 'PropertyDeleteController'
        })
    ;
}]);
