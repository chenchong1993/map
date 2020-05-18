<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no"/>
    <title>震源分布系统</title>
    <!-- 地图开始 -->
    <link rel="stylesheet" type="text/css" href="/Ips_api_javascript/dijit/themes/tundra/tundra.css"/>
    <link rel="stylesheet" type="text/css" href="/Ips_api_javascript/esri/css/esri.css"/>
    <link rel="stylesheet" type="text/css" href="/Ips_api_javascript/fonts/font-awesome-4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Ips_api_javascript/Ips/css/widget.css"/>
    <!-- 地图结束 -->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <!-- 地图 -->
    <script type="text/javascript" src="Ips_api_javascript/init.js"></script>
    <!-- 地图 -->
    <style>
        html, body, .map {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background: white;
        }
    </style>
</head>

<body class="tundra">

<div class="row" style="height: 100%">

    <div id="map" class="col-md-12"></div>

</div>
</body>

<script>

    // 初始化全局参数
    var POINTSIZE = 10;    //默认图片大小为24*24
    var map;

    //地图
    require([
        "esri/map",
        "esri/geometry/Extent",
        "Ips/layers/DynamicMapServiceLayer",
        "Ips/layers/FeatureLayer",
        "Ips/layers/GraphicsLayer",
        "esri/graphic",
        "esri/geometry/Point",
        "esri/geometry/Polyline",
        "esri/geometry/Polygon",
        "esri/InfoTemplate",
        "esri/symbols/SimpleMarkerSymbol",
        "esri/symbols/SimpleLineSymbol",
        "esri/symbols/SimpleFillSymbol",
        "esri/symbols/PictureMarkerSymbol",
        "esri/symbols/TextSymbol",
        "dojo/colors",
        "dojo/on",
        "dojo/dom",
        "dojo/domReady!"
    ], function (Map, Extent,DynamicMapServiceLayer, FeatureLayer, GraphicsLayer, Graphic, Point, Polyline, Polygon, InfoTemplate, SimpleMarkerSymbol, SimpleLineSymbol,
                 SimpleFillSymbol, PictureMarkerSymbol, TextSymbol, Color, on, dom) {
        var initialExtent = new Extent({
            "spatialReference": { "wkid": 4326 }
        });

        var map = new Map("map", {
            basemap:"osm",
            center:[108.29656182, 38.04275177],
            zoom:4,
            extent:initialExtent,
            logo:false
        });
        //初始化pointLayer 用户数据点图层
        var pointLayer = new GraphicsLayer();
        map.addLayer(pointLayer);

        /**
         * 添加点图标,日期，发震时刻，经度，纬度，深度，震级，地名

         * */
        function addUserPoint(date,time,lng,lat,depth,level,area) {
            //定义点的几何体
            var picpoint = new Point(lng,lat);
            // //定义点的图片符号
            var img_uri="/Ips_api_javascript/Ips/image/en.png";

            var picSymbol = new PictureMarkerSymbol(img_uri,POINTSIZE,POINTSIZE);
            //定义点的图片符号
            var attr = {"date": date,
                        "time": time,
                        "lng": lng,
                        "lat": lat,
                        "depth": depth,
                        "level": level,
                        "area": area,
            };
            //信息模板
            var infoTemplate = new InfoTemplate();
            infoTemplate.setTitle('震源信息');
            infoTemplate.setContent(
                "<b>日期:</b><span>${date}</span><br>"
                + "<b>发震时刻:</b><span>${time}</span><br>"
                + "<b>经度:</b><span>${lng}</span><br>"
                + "<b>纬度:</b><span>${lat}</span><br>"
                + "<b>深度:</b><span>${depth}</span><br>"
                + "<b>震级:</b><span>${level}</span><br>"
                + "<b>地名:</b><span>${area}</span><br>"
            );
            var picgr = new Graphic(picpoint, picSymbol, attr, infoTemplate);
            pointLayer.add(picgr);
            map.addLayer(pointLayer);
        }

        @foreach($lists as $list)
            {{--console.log("'"+'{{$list[6]}}'+"'");--}}
            addUserPoint(
                ""+'{{$list[0]}}'+"",
                ""+'{{$list[1]}}'+"",
                {{$list[2]}},
                {{$list[3]}},
                ""+'{{$list[4]}}'+"",
                ""+'{{$list[5]}}'+"",
                ""+'{{$list[6]}}'+""

            );
        @endforeach

    });




</script>
</html>