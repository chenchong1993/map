// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/3.17/esri/copyright.txt for details.
//>>built
define("esri/layers/StreamTrackManager","dojo/_base/declare dojo/_base/lang dojo/_base/array dojo/has ../kernel ../graphic ../geometry/Polyline ./TrackManager".split(" "),function(n,q,k,r,s,t,u,v){n=n([v],{declaredClass:"esri.layers._StreamTrackManager",constructor:function(a){this.inherited(arguments)},initialize:function(a){this.inherited(arguments)},addFeatures:function(a,d){function e(b,f){var a,e,c,l;g[b]||(g[b]=[]);a=g[b];0<h&&(f.length>h&&f.splice(0,f.length-h),c=f.length+a.length,c>h&&(e=
a.splice(0,c-h)));c=f.length;for(l=0;l<c;l+=1)a.push(f[l]);return{deletes:e,adds:f}}var g,b,l,h,c={},f={},p;if(d)return this.inherited(arguments),c;g=this.trackMap;b=this.layer;l=b._trackIdField;h=b.maximumTrackPoints||0;k.forEach(a,function(b){var a=b.attributes[l];b.visible&&(f[a]||(f[a]=[]),f[a].push(b))});for(p in f)f.hasOwnProperty(p)&&(b=e(p,f[p]),c[p]=b);return c},removeFeatures:function(a){var d=[],e=this.layer.objectIdField,g=this.layer._trackIdField;a&&(k.forEach(a,function(b){var a,h,c,
f;h=b.attributes[g];a=b.attributes[e];if(c=this.trackMap[h])for(b=0;b<c.length;b+=1)if(f=c[b],f.attributes[e]===a){this.trackMap[h].splice(b,1);-1===k.indexOf(h)&&d.push(h);break}},this),0<a.length&&this.refreshTracks(d))},drawTracks:function(a){function d(a){var c=b[a],d=c&&1<c.length,k,n,m;if((m=e.trackLineMap[a])&&!d)g.remove(m),delete e.trackLineMap[a],m=null;if(!d)return!1;d=[];for(k=c.length-1;0<=k;k-=1)(n=c[k].geometry)&&d.push([n.x,n.y]);c={};c[h]=a;1<d.length&&(m?(a=m.geometry,a.removePath(0),
a.addPath(d),m.setGeometry(a)):(m=new t(new u({paths:[d],spatialReference:l}),null,c),g.add(m),e.trackLineMap[a]=m))}var e=this,g=this.container,b,l,h,c;if(g)if(b=this.trackMap,l=this.map.spatialReference,h=this.layer._trackIdField,a)k.forEach(a,function(a){d(a)});else for(c in b)b.hasOwnProperty(c)&&d(c)},refreshTracks:function(a){function d(a){var b,c;a=e[a]||[];b=a.length;for(c=0;c<b;c++)g._repaint(a[c],null,!0)}var e=this.trackMap,g=this.layer;g._getRenderer();var b;this.drawTracks(a);if(a)k.forEach(a,
function(a){d(a)});else for(b in e)e.hasOwnProperty(b)&&d(b)},getLatestObservations:function(){var a,d,e=this.trackMap,g=[];for(a in e)e.hasOwnProperty(a)&&(d=e[a],g.push(d[d.length-1]));return g},destroy:function(){this.inherited(arguments);this.trackLineMap=null}});r("extend-esri")&&q.setObject("layers._StreamTrackManager",n,s);return n});