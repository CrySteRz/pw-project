<script>
	import AdminMenu from "../../lib/components/AdminMenu.svelte";
</script>

<div class="app">
	<main>
		<div class="card container myGlassEffect">
			<div class="card-header">
				<div class="loggedInHeader px-8 myGlassEffect">
					<h1> Salut, Admin</h1>
					<div>
						<button class="btnLocalization">en</button>
						<button class="btnLocalization">ro</button>
					</div>	
				</div>
			</div>
			<div class="card-body layoutCardBody">
				<section class="sectionMainCard">
					<div class="admin-layout myGlassEffect">
						<AdminMenu/>
						<section class="p-2">
							<slot></slot>
						</section>
					</div>
				</section>
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
		background-image: url('/cool-background2.png');
	}

	main{
		width: 100dvw;
		height: 100dvh;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.loggedInHeader{
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	
	.btnLocalization{
		background-color: transparent;
		border: 1px solid black;
		border: none;
		border-radius: 5px;
		padding: 5px;
		margin: 5px;
	}

	.layoutCardBody{
		height: calc(100dvh - 20rem);
	}

	.admin-layout {
		display: grid;
		grid-template-columns: 200px 1fr;
	}
	
	.sectionMainCard{
		display: grid;
		grid-template-columns: 1fr;
		grid-template-rows:1fr;
		height: 100%;
	}
	
</style>
