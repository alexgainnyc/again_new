	Manager.directive('contentType', ['$timeout', '$rootScope', function($timeout, $rootScope){
		return {
			restrict: 'A',
			controller: function ($scope, $http) {
				
			},
			link: function(scope, elm, attrs) {
				scope.data.then(function (data) {
					var typeMap = {
						type1: [
							"text",
							"tags"
						],
						type2: [
							"assetLeft",
							"assetRight"
						],
						type3: [
							"caption",
							"assetRight"
						],
						type4: [
							"assetLeft",
							"caption"
						],
						type5: [
							"assetLeft",
							"size"
						],
						type6: [
							"text",
							"fontSize"
						],
						type7: [
							"assetLeft",
							"videoMp4",
							"videoWebm",
							"size"
						],
						type8: [ ]
					};

					var update = function () {
						if (data.data.type)
						{
							_.each(scope.subformFields, function (field) {
								if (field.name != "type")
								{
									data.data[field.name + "Hidden"] = true;
								}
							});

							_.each(typeMap["type" + data.data.type], function (name) {
								_.each(scope.subformFields, function (field) {
									if (field.name == name)
									{
										delete data.data[field.name + "Hidden"];
									}
								});
							});
						}
						else
						{
							_.each(scope.subformFields, function (field) {
								if (field.name != "type")
								{
									data.data[field.name + "Hidden"] = true;
								}
							});
						}
					};;

					scope.$watch("data.data.type", function (value) {
						update();
					}, true);

					update();
				});
			}
		}
	}]);