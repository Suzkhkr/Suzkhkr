
import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import axios from 'axios';

var calendarEl = document.getElementById("calendar");

let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin],
    initialView: "dayGridMonth",
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "",
    },
    dateClick: function(info) {
        console.log('click');
    },

    // 日付をクリック、または範囲を選択したイベント
    selectable: true,
    select: function (info) {
        alert("selected " + info.startStr + " to " + info.endStr);
        const eventName = prompt("イベントを入力してください");
    
        if (eventName) {
            calendar.addEvent({
                title: eventName,
                start: info.start,
                end: info.end,
                allDay: true,
            });
        }
    },
});
calendar.render();
