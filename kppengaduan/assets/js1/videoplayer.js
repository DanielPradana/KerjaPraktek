var GLOBAL_STRINGS = {
    "PLAY": "Play",
    "PAUSE": "Pause",
    "TOGGLE_FULL_SCREEN": "Toggle full screen",
    "MUTE": "Mute",
    "RESTART": "Restart",
    "CAPTIONS": "Closed captions",
    "REWIND": "Rewind",
    "FORWARD": "Forward"
}

function InitPxVideo(options) {

	"use strict";

  document.getElementById("player").src = "https://goo.gl/q0j3E7";
  //document.getElementById("player").src = "https://www.paypalobjects.com/webstatic/mktg/videos/PayPal_AustinSMB_baseline.mp4";
  
  //https://developer.mozilla.org/en-US/docs/Web/Guide/API/DOM/Using_full_screen_mode
	// launch fullscreen
	function launchFullScreen(elem) {
	  if (!elem.fullscreenElement &&    // alternative standard method
	      !elem.mozFullScreenElement && !elem.webkitFullscreenElement && !elem.msFullscreenElement ) {  // current working methods
  		var requestFullScreen = elem.requestFullscreen || elem.msRequestFullscreen || elem.mozRequestFullScreen || elem.webkitRequestFullscreen;
  		requestFullScreen.call(elem);
	  }
	}

	// change styles of fullscreen accordingly
	function fullScreenStyles() {
		if (document.fullscreen || document.mozFullScreen || document.webkitIsFullScreen || document.msFullscreenElement) {
			obj.fullScreenBtn.checked = true;
			//must apply other styles in container
			obj.container.setAttribute("style", "width: 100%; height: 100%;");
			obj.controls.className = "px-video-controls js-fullscreen-controls";
			obj.captionsContainer.className = "px-video-captions js-fullscreen-captions";
			obj.movie.setAttribute('width', '100%');
			obj.movie.setAttribute('height', '100%');
		} else {
			obj.fullScreenBtn.checked = false;
	    // revert back to default styles
	    obj.container.setAttribute("style", "width:" + obj.movieWidth + "px");
			obj.controls.className = "px-video-controls";
			obj.captionsContainer.className = "px-video-captions";
	    obj.movie.setAttribute('width', obj.movieWidth);
			obj.movie.setAttribute('height', obj.movieHeight);
		}
	}

	// exit fullscreen
	function exitFullScreen() {
		// get appropriate vendor prefix and then call it with respect to the document
		var exitFullScreen = document.exitFullscreen || document.msExitFullscreen || document.mozCancelFullScreen || document.webkitExitFullscreen;
    exitFullScreen.call(document);
	}

	// Global variable
	var obj = {};

		// Get the container, video element, and controls container
	obj.container = document.getElementById(options.videoId);
	obj.movie = obj.container.getElementsByTagName('video')[0];
	obj.controls = obj.container.getElementsByClassName('px-video-controls')[0];

	// Remove native video controls
	obj.movie.removeAttribute("controls");

	// Generate random number for ID/FOR attribute values for controls
	obj.randomNum = Math.floor(Math.random() * (10000));

	obj.controls.innerHTML = '<div class="clearfix">' +
			'<div class="pull-left">' +
				'<button class="px-video-restart" title="' + GLOBAL_STRINGS['RESTART'] + '"><span class="sr-only">' + GLOBAL_STRINGS['RESTART'] + '</span></button>' +
				'<button class="px-video-rewind" title="' + GLOBAL_STRINGS['REWIND'] + '"><span class="sr-only">rewind <span class="px-seconds">10</span> seconds</span></button>' +
				'<button class="px-video-play" aria-label="'+obj.playAriaLabel+'" title="' + GLOBAL_STRINGS['PLAY'] + '"><span class="sr-only">' + GLOBAL_STRINGS['PLAY'] + '</span></button>' +
				'<button class="px-video-pause hide" title="' + GLOBAL_STRINGS['PAUSE'] + '"><span class="sr-only">' + GLOBAL_STRINGS['PAUSE'] + '</span></button>' +
				'<button class="px-video-forward" title="' + GLOBAL_STRINGS['FORWARD'] + '""><span class="sr-only">forward <span class="px-seconds">10</span> seconds</span></button>' +
			'</div>' +
			'<div class="px-video-mute-btn-container pull-left" title="' + GLOBAL_STRINGS['MUTE'] + '">' +
				'<input class="px-video-mute sr-only" id="btnMute'+obj.randomNum+'" type="checkbox" />' +
				'<label id="labelMute'+obj.randomNum+'" for="btnMute'+obj.randomNum+'"><span class="sr-only">' + GLOBAL_STRINGS['MUTE'] + '</span></label>' +
			'</div>' +
			'<div class="pull-left">' +
				'<label for="volume'+obj.randomNum+'" class="sr-only">Volume:</label><input id="volume'+obj.randomNum+'" class="px-video-volume" type="range" min="0" max="10" value="5" />' +
			'</div>' +
			'<div class="px-video-captions-btn-container pull-left show" title="' + GLOBAL_STRINGS['CAPTIONS'] + '">' +
				'<input class="px-video-btnCaptions sr-only" id="btnCaptions'+obj.randomNum+'" type="checkbox" checked/>' +
				'<label for="btnCaptions'+obj.randomNum+'"><span class="sr-only">' + GLOBAL_STRINGS['CAPTIONS'] + '</span></label>' +
			'</div>' +
			'<div class="px-video-fullscreen-btn-container pull-left show" title="' + GLOBAL_STRINGS['TOGGLE_FULL_SCREEN'] + '">' +
				'<input class="px-video-btnFullScreen sr-only" id="btnFullscreen'+obj.randomNum+'" type="checkbox" />' +
				'<label for="btnFullscreen'+obj.randomNum+'"><span class="sr-only">' + GLOBAL_STRINGS['TOGGLE_FULL_SCREEN'] + '</span></label>' +
			'</div>' +
			'<div class="px-video-time">' +
				'<span class="sr-only">time</span> <span class="px-video-duration">00:00</span>' +
			'</div>' +
		'</div>' +
		'<div>' +
			'<progress class="px-video-progress" max="100" value="0"><span>0</span>% played</progress>' +
		'</div>';

	// Adjust layout per width of video - container
	obj.movieWidth = obj.movie.width;
	if (obj.movieWidth < 360) {
		obj.movieWidth = 360;
	}
	obj.container.setAttribute("style", "width:" + obj.movieWidth + "px");

	// Added for fullscreen reference
	obj.movieHeight = obj.movie.height;

	// Adjust layout per width of video - controls/mute offset
	obj.labelMute = document.getElementById("labelMute" + obj.randomNum);
	obj.labelMuteOffset = obj.movieWidth - 390;
	if (obj.browserName==="Firefox") { // adjust for Firefox rendering
		obj.labelMuteOffset = obj.labelMuteOffset - 10;
	}
	if (obj.labelMuteOffset < 0) {
		obj.labelMuteOffset = 0;
	}
	obj.labelMute.setAttribute("style", "margin-left:" + obj.labelMuteOffset + "px");

	// Number of seconds for rewind and forward buttons
	if (typeof(options.seekInterval) === 'undefined') {
		options.seekInterval = 10;
	}
	obj.seekInterval = options.seekInterval;

	// Get the elements for the controls
	obj.btnPlay = obj.container.getElementsByClassName('px-video-play')[0];
	obj.btnPause = obj.container.getElementsByClassName('px-video-pause')[0];
	obj.btnRestart = obj.container.getElementsByClassName('px-video-restart')[0];
	obj.btnRewind = obj.container.getElementsByClassName('px-video-rewind')[0];
	obj.btnForward = obj.container.getElementsByClassName('px-video-forward')[0];
	obj.btnVolume = obj.container.getElementsByClassName('px-video-volume')[0];
	obj.btnMute = obj.container.getElementsByClassName('px-video-mute')[0];
	obj.progressBar = obj.container.getElementsByClassName('px-video-progress')[0];
	obj.progressBarSpan = obj.progressBar.getElementsByTagName('span')[0];
	obj.captionsContainer = obj.container.getElementsByClassName('px-video-captions')[0];
	obj.captionsBtn = obj.container.getElementsByClassName('px-video-btnCaptions')[0];
	obj.captionsBtnContainer = obj.container.getElementsByClassName('px-video-captions-btn-container')[0];
	obj.duration = obj.container.getElementsByClassName('px-video-duration')[0];
	obj.txtSeconds = obj.container.getElementsByClassName('px-seconds');
	obj.fullScreenBtn = obj.container.getElementsByClassName('px-video-btnFullScreen')[0];
	obj.fullScreenBtnContainer = obj.container.getElementsByClassName('px-video-fullscreen-btn-container')[0];

	// Update number of seconds in rewind and fast forward buttons
	obj.txtSeconds[0].innerHTML = obj.seekInterval;
	obj.txtSeconds[1].innerHTML = obj.seekInterval;

	// Determine if HTML5 textTracks is supported (for captions)
	obj.isTextTracks = false;
	if (obj.movie.textTracks) {
		obj.isTextTracks = true;
	}

	// Play
	obj.btnPlay.addEventListener('click', function() {
		obj.movie.play();
		obj.btnPlay.className = "px-video-play hide";
		obj.btnPause.className = "px-video-pause px-video-show-inline";
		obj.btnPause.focus();
	}, false);

	// Pause
	obj.btnPause.addEventListener('click', function() {
		obj.movie.pause();
		obj.btnPlay.className = "px-video-play px-video-show-inline";
		obj.btnPause.className = "px-video-pause hide";
		obj.btnPlay.focus();
	}, false);

	// Restart
	obj.btnRestart.addEventListener('click', function() {
		// Move to beginning
		obj.movie.currentTime = 0;

		// Special handling for "manual" captions
		if (!obj.isTextTracks) {
			obj.subcount = 0;
		}

		// Play and ensure the play button is in correct state
		obj.movie.play();
		obj.btnPlay.className = "px-video-play hide";
		obj.btnPause.className = "px-video-pause px-video-show-inline";

	}, false);

	// Rewind
	obj.btnRewind.addEventListener('click', function() {
	    var targetTime = obj.movie.currentTime - obj.seekInterval;
	    if (targetTime < 0) {
	      obj.movie.currentTime = 0;
	    }
	    else {
	      obj.movie.currentTime = targetTime;
	    }
	}, false);

	// Fast forward
	obj.btnForward.addEventListener('click', function() {
	    var targetTime = obj.movie.currentTime + obj.seekInterval;
		if (targetTime > obj.movie.duration) {
			obj.movie.currentTime = obj.movie.duration;
		}
		else {
			obj.movie.currentTime = targetTime;
		}
	}, false);

	// Get the HTML5 range input element and append audio volume adjustment on change
	obj.btnVolume.addEventListener('change', function() {
		obj.movie.volume = parseFloat(this.value / 10);
	}, false);

	// Mute
	obj.btnMute.addEventListener('click', function() {
		if (obj.movie.muted === true) {
			obj.movie.muted = false;
		} else {
			obj.movie.muted = true;
		}
	}, false);

	// Duration
	obj.movie.addEventListener("timeupdate", function() {
		obj.secs = parseInt(obj.movie.currentTime % 60);
		obj.mins = parseInt((obj.movie.currentTime / 60) % 60);

		// Ensure it's two digits. For example, 03 rather than 3.
		obj.secs = ("0" + obj.secs).slice(-2);
		obj.mins = ("0" + obj.mins).slice(-2);

		// Render
		obj.duration.innerHTML = obj.mins + ':' + obj.secs;
	}, false);

	// Progress bar
	obj.movie.addEventListener('timeupdate', function() {
		obj.percent = (100 / obj.movie.duration) * obj.movie.currentTime;
		if (obj.percent > 0) {
			obj.progressBar.value = obj.percent;
			obj.progressBarSpan.innerHTML = obj.percent;
		}
	}, false);

	// Skip when clicking progress bar
	obj.progressBar.addEventListener('click', function(e) {
		obj.pos = (e.pageX - this.offsetLeft) / this.offsetWidth;
		obj.movie.currentTime = obj.pos * obj.movie.duration;

	});

	// Toggle display of fullscreen button
	obj.fullScreenBtn.addEventListener('click', function() {
		if (this.checked) {
			launchFullScreen(obj.container);
		} else {
			exitFullScreen();
		}
	}, false);

	// Clear captions at end of video
	//obj.movie.addEventListener('ended', function() {
		obj.captionsContainer.innerHTML = "Test";
	//});

	// ***
	// Captions
	// ***

	// Toggle display of captions via captions button
	obj.captionsBtn.addEventListener('click', function() {
		if (this.checked) {
			obj.captionsContainer.className = "px-video-captions show";
		} else {
			obj.captionsContainer.className = "px-video-captions hide";
		}
	  // if fullscreen add fullscreen class
    if (document.fullscreen || document.mozFullScreen || document.webkitIsFullScreen || document.msFullscreenElement) {
      var currClass = obj.captionsContainer.className;
      obj.captionsContainer.className = currClass + ' js-fullscreen-captions';
    }
	}, false);

	document.addEventListener("fullscreenchange", function () {
		fullScreenStyles();
	}, false);

	document.addEventListener("mozfullscreenchange", function () {
		fullScreenStyles();
	}, false);

	document.addEventListener("webkitfullscreenchange", function () {
	  fullScreenStyles();
	}, false);

	document.addEventListener("MSFullscreenChange", function () {
	 	fullScreenStyles();
	}, false);
};

// Initialize
new InitPxVideo({
	"videoId": "myvid",
	"seekInterval": 20,
	"videoTitle": "Video promo",
});
