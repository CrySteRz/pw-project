<script>
	import './styles.css';
	import "tailwindcss/tailwind.css";
</script>

<div class="app">
	<main>
		<div class="card w-96 glass">
			<div class="card-body">
			  <slot />
			</div>
		  </div>

			
	</main>
</div>

<style>
	.app{
		background-color: #f2f2f2;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		/* background-image: url('$lib/images/wraper_back.jpg'); */
		background-image: url('$lib/images/cool-background.svg');
	}

	main{
		width: 100dvw;
		height: 100dvh;
		display: flex;
		justify-content: center;
		align-items: center;
	}

</style>
