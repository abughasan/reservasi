<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">RESERVASI VILLA</a>	  
    </div>
	
    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">				
		<a class="btn btn-default navbar-btn" onclick="myFunction()"><?=showicon('print')?> Print</a>	
		<a class="btn btn-warning navbar-btn" onclick="close_window()"><?=showicon('remove')?> Cancel</a>	
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	
	
<script>
function myFunction() {
    window.print();
}

function close_window() {
  if (confirm("Close Window?")) {
   window.close();
  }  
}

</script>	