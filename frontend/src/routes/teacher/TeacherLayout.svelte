<script>
	import HeaderStudentWeb from '../../lib/components/HeaderStudentWeb.svelte';
	import ContextMenu from '../../lib/components/ContextMenu.svelte';
	import { jwtData } from "../../lib/utils";
	import { onMount } from "svelte";
    import TeacherMenu from '../../lib/components/TeacherMenu.svelte';
	let studentData = {};
	onMount(() => {
		studentData = jwtData();
		// checkJwt(2);
	});
</script>

	<div class="app">
		<main>
			<div class="card container myGlassEffect">
				<div class="card-header">
					<div class="loggedInHeader px-8 myGlassEffect">
						<h1>Salut, {studentData.user_complete_name}</h1>
						<div>
							<button class="btnLocalization">en</button>
							<button class="btnLocalization">ro</button>
						</div>	
					</div>
				</div>
				<div class="card-body layoutCardBody">
					<section class="sectionMainCard">
						<HeaderStudentWeb />
						<div class="mainContent myGlassEffect">
							<TeacherMenu />
							<div class="ActualContent">
								<slot />
							</div>
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

	.ActualContent{
		padding: 0.5rem;
}

	.sectionMainCard{
		display: grid;
		grid-template-columns: 1fr;
		grid-template-rows: 50px 1fr;
		height: 100vh;
		gap: 1rem;
	}

	.mainContent{
		display: grid;
		grid-template-columns: 205px 1fr;
		height: 100%;
	}


	
</style>
