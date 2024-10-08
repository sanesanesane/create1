

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geocoding and Map Example</title>
    <!-- Google Maps APIの読み込み -->
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0ci2WqvcWCQ7Z2qe_NEEt6RRGv1KLn2U&callback=initMap&libraries=maps,marker&v=beta">
    </script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      gmp-map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #map {
        height: 100%;
        width: 100%;
      }
    </style>
    <script>
      function getCoordinates(address) {
        const apiKey = 'AIzaSyC0ci2WqvcWCQ7Z2qe_NEEt6RRGv1KLn2U';  // ここにご自身のAPIキーを入力
        const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${apiKey}`;

        fetch(url)
          .then(response => response.json())
          .then(data => {
            if (data.status === 'OK') {
              const location = data.results[0].geometry.location;
              // 緯度と経度を使って地図を更新
              initMap(location.lat, location.lng);
            } else {
              console.error('Geocodingに失敗しました: ' + data.status);
            }
          })
          .catch(error => console.error('エラーが発生しました: ', error));
      }

      function initMap(lat = 40.12150192260742, lng = -100.45039367675781) {
        const map = new google.maps.Map(document.getElementById('map'), {
          center: { lat: lat, lng: lng },
          zoom: 14
        });

        new google.maps.Marker({
          position: { lat: lat, lng: lng },
          map: map,
          title: '指定された場所'
        });
      }

      window.onload = function() {
        const address = "{{ $site }}";  // PHPから取得した住所をJavaScriptに渡す
        getCoordinates(address); // 住所から緯度経度を取得し、その位置に地図を表示
      };
    </script>
</head>
<body>
    <h1>Geocodingと地図表示の統合例</h1>
    <div id="map"></div>
</body>
</html>
