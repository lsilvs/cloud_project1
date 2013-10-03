//var topArt;
 $(document).ready(function() {
    $.getJSON("http://ws.audioscrobbler.com/2.0/?method=geo.gettopartists&country=ireland&api_key=b839d2beacdabdb395406600092eeeff&format=json", function(data) {
        var html = '';
        $.each(data.topartists.artist, function(i, item) {
            html += "<tr><td>" + item.name + "</td><td>" + item.listeners + "</td></tr>";
        });
        $('#test table tbody').append(html);
         // topArt = data.topartists;
    });
});