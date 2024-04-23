<script>
    import { Link } from "svelte-routing";

</script>
<nav  data-sveltekit-reload class="contextMenu">
    <Link class="myNavSidebarLink" to="/student/studentData"> Date student</Link>
    <Link class="myNavSidebarLink" to="/student/disciplines"> Discipline</Link>
    <Link class="myNavSidebarLink" to="/student/grades"> Note </Link>
    <Link class="myNavSidebarLink" to="/logout"> Deconectare </Link>
</nav>

<style>

	.contextMenu{
		border-right: 1px solid  rgb(107 114 128);
	}

	.contextMenu a{
		padding: 10px;
		border-bottom: 1px solid  rgb(107 114 128);
		display: block;
	}

</style>