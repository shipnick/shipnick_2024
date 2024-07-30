<?php
$total = $allcomplete + $allpending + $allcancel + $alluploaded + $allcanceled;
if($total==0){
?>
	<center><h3>Result Not Found</h3></center>
<?php
}else{
?>

<canvas id="myChart" width="400" height="400"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
		type: 'pie',
		data: {
				labels: ['Delivered', 'Process', 'RTO', 'Not Picked', 'Canceled'],
				datasets: [{
						// label: '# of Votes',
						data: [{{ $allcomplete }},{{ $allpending }},{{ $allcancel }},{{ $alluploaded }},{{ $allcanceled }}],
						backgroundColor: [
							'#1974cf',
							'#3485d7',
							'#5b96d3',
							'#80a6cd',
							'#a2b7cd'
						],
						borderWidth: 1
				}]
		},
});
</script>

<?php
}
?>
