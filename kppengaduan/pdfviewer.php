

  <!-- Use latest PDF.js build from Github -->
	
	
	
  <script type="text/javascript">
  
  var app = angular.module('pdfApp', []);
app.directive('pdfViewer', function() {

  return {

    template: "<canvas id='the-canvas' style='border:1px solid black; width:100%;'></canvas><br>"

  }

});

app.controller('pdfCtrl', function($scope) {

  $scope.viewClaim = function(url) {
    $scope.pdfURL = url;
    PDFJS.disableWorker = true;
    //console.log(PDFJS);
    $scope.pageNum = 1;

    $scope.page = function(x) {

      PDFJS.getDocument($scope.pdfURL).then(function getPdfHelloWorld(pdf) {
        //
        // Fetch the first page
        //
        $scope.pageCount = pdf.numPages;
        pdf.getPage($scope.pageNum).then(function getPageHelloWorld(page) {
          var scale = 1.5;

          console.log("page count.." + $scope.pageCount);
          var viewport = page.getViewport(scale);

          //
          // Prepare canvas using PDF page dimensions
          //
          var canvas = document.getElementById('the-canvas');
          var context = canvas.getContext('2d');
          canvas.height = viewport.height;
          canvas.width = viewport.width;

          //
          // Render PDF page into canvas context
          //
          page.render({
            canvasContext: context,
            viewport: viewport
          });
        });

        if (x == "prev") {
          $scope.pageNum = $scope.pageNum - 1;
          if ($scope.pageNum < 1) {
            $scope.pageNum = 1;
          }

        }
        if (x == "next") {
          $scope.pageNum = $scope.pageNum + 1
        }
        if ($scope.pageNum > $scope.pageCount) {
          $scope.pageNum = $scope.pageCount;
        }

      });

    };

    

  }
});
</script>
	
  

