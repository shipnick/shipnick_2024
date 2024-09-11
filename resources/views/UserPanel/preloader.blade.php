<style>
	/* Preloader Styles */
	#preloader {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	
		z-index: 9999;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.progress-bar {
		width: 100%;
		/*background: #e0e0e0;*/
		border-radius: 5px;
		overflow: hidden;
		position: relative;
	}

	.progress-bar .bar {
		height: 5px;
		background: #008040;
		width: 0%; /* Start at 0% */
		transition: width 2s ease; /* Smooth transition over 2 seconds */
	}

	.progress-bar::before {
		/*content: 'Loading...';*/
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		font-size: 14px;
		color: #333;
	}
</style>



<div id="preloader"></div>
	<div class="progress-bar">
		<div class="bar" id="progress"></div>
	</div>
	</div>   
	
	
	<script >
	// Function to animate the progress bar to 100%
	function animateProgressBar() {
		document.getElementById('progress').style.width = '100%';
	}

	// Start the animation after the DOM has loaded
	window.addEventListener('load', () => {
		animateProgressBar();

		// Optionally, hide the preloader after the animation ends
		setTimeout(() => {
			document.getElementById('preloader').style.display = 'none'; // Hide preloader
		}, 50000); // Match this with the duration of the CSS transition (2 seconds)
	});
</script>