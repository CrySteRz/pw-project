<script>
    import { Link } from "svelte-routing";

</script>
<nav  data-sveltekit-reload class="admin-menu">
    <Link class="myNavSidebarLink" to="/admin/students"> Students</Link>
    <Link class="myNavSidebarLink" to="/admin/teachers"> Teachers</Link>
    <Link class="myNavSidebarLink" to="/admin/disciplines"> Disciplines </Link>
    <Link class="myNavSidebarLink" to="/admin/grades"> Grades </Link>
    <Link class="myNavSidebarLink" to="/logout"> Deconectare </Link>
</nav>

<style>

	.admin-menu{
		border-right: 1px solid  rgb(107 114 128);
	}


</style>