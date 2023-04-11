$(document).ready(function() {

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe("perangkat-log");

    // Bind a function to a Event (the full Laravel class)
    channel.bind("perangkat-statistic", function (response) {
        // this is called when the event notification is received...
        let data = response.history;
        let html = data.suhu + "'" + data.perangkat.satuan_suhu;
        $("#suhu-perangkat-" + data.perangkat_id).html(html);
    });
})