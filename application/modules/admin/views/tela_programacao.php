<ul class="tabs" tabs>
	<li class="tab"><a class="active" href="#programas">Programas</a></li>
	<li class="tab"><a href="#grade">Grade de Programação</a></li>    
</ul>
<div style="margin-top: -7px;">
	<div id="programas" class="col s12">
		<div class="row">
			<div class="col s12 m12">
				<div class="card">
					<div class="card-content">
						<?php $this->load->view('listagem_programacao'); ?>
					</div>			
				</div>
			</div>
		</div>
	</div>
	<div id="grade" class="col s12" >
		<div class="row">
			<div class="col s12 m12">
				<div class="card">
					<div class="card-content">
						<?php $this->load->view('grade_programacao'); ?>						
					</div>			
				</div>
			</div>
		</div>
	</div>
</div>