	<div class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">RESERVASI VILLA</a>
        </div>
        <div class="navbar-collapse collapse">
		
          <form class="navbar-form navbar-right" role="form" method="POST" action="<?=base_url();?>app/ceklogin">
            <div class="form-group">
              <input type="text" name="username" placeholder="Username" class="form-control" required>
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Masuk</button>
          </form>
		  
        </div><!--/.navbar-collapse -->
      </div>
    </div>