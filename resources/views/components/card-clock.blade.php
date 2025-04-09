
<style>
       /* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

:root {
    --primary-color: #f6f7fb;
    --white-color: #fff;
    --black-color: #18191a;
    --red-color: #e74c3c;
}

body.dark {
    --primary-color: #242526;
    --white-color: #18191a;
    --black-color: #fff;
    --red-color: #e74c3c;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.container .clock {
    display: flex;
    height: 200px;
    width: 200px;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    background: var(--white-color);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1), 0 25px 45px rgba(0, 0, 0, 0.1);
    position: relative;
}

.clock label {
    position: absolute;
    inset: 15px;
    text-align: center;
    transform: rotate(calc(var(--i) * (360deg / 12)));
}

.clock label span {
    display: inline-block;
    font-size: 15px;
    font-weight: 600;
    color: var(--black-color);
    transform: rotate(calc(var(--i) * (-360deg / 12)));
}

.container .indicator {
    position: absolute;
    height: 10px;
    width: 10px;
    display: flex;
    justify-content: center;
}

.indicator::before {
    content: "";
    position: absolute;
    height: 100%;
    width: 100%;
    border-radius: 50%;
    z-index: 100;
    background: var(--black-color);
    border: 4px solid var(--red-color);
}

.indicator .hand {
    position: absolute;
    height: 80px;
    width: 3px;
    bottom: 0;
    border-radius: 25px;
    transform-origin: bottom;
    background: var(--red-color);
}

.hand.minute {
    height: 70px;
    width: 4px;
    background: var(--black-color);
}

.hand.hour {
    height: 60px;
    width: 6px;
    background: var(--black-color);
}

.mode-switch {
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 22px;
    font-weight: 400;
    display: inline-block;
    color: var(--white-color);
    background: var(--black-color);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

.datetime {
    font-size: 15px;
    font-weight: 500;
    color: var(--black-color);
    margin-bottom: 15px;
}

@media (min-width: 880px) {

    .datetime {
        font-size: 8px;
    }
    .container .clock {
        width: 140px;
        height: 140px;
    }


    .clock label {
        position: absolute;
        inset: 10px;
        text-align: center;
        transform: rotate(calc(var(--i) * (360deg / 12)));
    }

    .clock label span {
        display: inline-block;
        font-size: 12px;
        font-weight: 600;
        color: var(--black-color);
        transform: rotate(calc(var(--i) * (-360deg / 12)));
    }

    .indicator .hand {
        position: absolute;
        height: 50px;
        width: 3px;
    }

    .hand.minute {
        height: 42px;
        width: 3px;
    }

    .hand.hour {
        height: 35px;
        width: 5px;
    }
}

@media (min-width: 980px) {

    .datetime {
        font-size: 10px;
    }
    .container .clock {
        width: 160px;
        height: 160px;
    }
    
    
    .clock label {
        position: absolute;
        inset: 10px;
        text-align: center;
        transform: rotate(calc(var(--i) * (360deg / 12)));
    }

    .clock label span {
        display: inline-block;
        font-size: 12px;
        font-weight: 600;
        color: var(--black-color);
        transform: rotate(calc(var(--i) * (-360deg / 12)));
    }

    .indicator .hand {
        position: absolute;
        height: 50px;
        width: 3px;
    }

    .hand.minute {
        height: 42px;
        width: 3px;
    }

    .hand.hour {
        height: 35px;
        width: 5px;
    }
}

@media (min-width: 1000px) {
    .container .clock {
        width: 200px;
        height: 200px;
    }

    .datetime {
        font-size: 11px;
    }

}


@media (min-width: 1200px) {
    .container .clock {
        width: 230px;
        height: 230px;
    }

    .datetime {
        font-size: 13px;
    }

    .clock label span {
        font-size: 12px;
    }

    .indicator .hand {
        position: absolute;
        height: 80px;
        width: 3px;
    }

    .hand.minute {
        height: 70px;
        width: 4px;
    }

    .hand.hour {
        height: 65px;
        width: 6px;
    }

}
</style>

<div class="container">
    <div class="datetime">
        <span id="date-time"></span>
    </div>

    <div class="clock">
        <label style="--i: 1"><span>1</span></label>
        <label style="--i: 2"><span>2</span></label>
        <label style="--i: 3"><span>3</span></label>
        <label style="--i: 4"><span>4</span></label>
        <label style="--i: 5"><span>5</span></label>
        <label style="--i: 6"><span>6</span></label>
        <label style="--i: 7"><span>7</span></label>
        <label style="--i: 8"><span>8</span></label>
        <label style="--i: 9"><span>9</span></label>
        <label style="--i: 10"><span>10</span></label>
        <label style="--i: 11"><span>11</span></label>
        <label style="--i: 12"><span>12</span></label>
        <div class="indicator">
            <span class="hand hour"></span>
            <span class="hand minute"></span>
            <span class="hand second"></span>
        </div>
    </div>
</div>
  

<script>

        const updateDateTime = () => {
            const dateTimeElement = document.getElementById("date-time");
            const date = new Date();
            
            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            const dayOfWeek = daysOfWeek[date.getDay()];
            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            
            const hours = date.getHours().toString().padStart(2, "0");
            const minutes = date.getMinutes().toString().padStart(2, "0");
            const seconds = date.getSeconds().toString().padStart(2, "0");
            
            dateTimeElement.textContent = `${dayOfWeek}, ${month} ${day}, ${year} - ${hours}:${minutes}:${seconds}`;
        };

        hourHand = document.querySelector(".hour"),
        minuteHand = document.querySelector(".minute"),
        secondHand = document.querySelector(".second"),
        modeSwitch = document.querySelector(".mode-switch");
    
      
        const updateTime = () => {
            let date = new Date(),
                secToDeg = (date.getSeconds() / 60) * 360,
                minToDeg = (date.getMinutes() / 60) * 360,
                hrToDeg = (date.getHours() / 12) * 360;
            // Rotate the clock hands to the appropriate degree based on the current time
            secondHand.style.transform = `rotate(${secToDeg}deg)`;
            minuteHand.style.transform = `rotate(${minToDeg}deg)`;
            hourHand.style.transform = `rotate(${hrToDeg}deg)`;
        };

        setInterval(updateTime, 1000);
        updateTime();
        updateDateTime();
</script>