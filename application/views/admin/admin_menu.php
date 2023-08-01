<nav class="bottom-nav container-fluid">
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class=" <?php echo ($current_page === 'dashboard') ? 'active' : 'text-white'; ?>"
				href="Conta_controller">
				<i class="bi bi-clipboard-data"></i>
				<p class="menu-text">Dashboard</p>
			</a>
		</div>
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class=" <?php echo ($current_page === 'planilhas') ? 'active' : 'text-white'; ?>"
				href="Planilhas_controller">
				<i class="bi bi-pie-chart-fill"></i>
				<p class="menu-text">Relátórios</p>
			</a>
		</div>
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="text-white" id="acessarApp">
				<i class="bi bi-phone-fill"></i>
				<p class="menu-text">Acessar o aplicativo</p>
			</a>
		</div>
	</div>
	<div class="bottom-nav-item">
		<div class="bottom-nav-item-content">
			<a class="link-danger" id="fazerLogout">
				<i class="bi bi-box-arrow-right"></i>
				<p class="menu-text">Sair</p>
			</a>
		</div>
	</div>
</nav>