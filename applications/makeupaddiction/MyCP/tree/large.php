<?php 
include('header.php'); ?>

<link rel="stylesheet" href="tree/jquery.treeview.css" />

<script src="tree/jquery.treeview.js" type="text/javascript"></script>

<script type="text/javascript">
		$(function(){
			$("#tree").treeview({
				collapsed: true,
				animated: "medium",
				//control:"#sidetreecontrol",
				persist: "location"
			});
		})

	</script>

<div id="sidetree">
<div class="treeheader">&nbsp;</div>


<ul id="tree">
	
	<li><span><strong>Category main M1</strong></span>
	   <ul>
       		<li><b>Sub Cat S1 </b>
            	<ul>
                	<li>S R 1
                    	<ul>
                        	<li>L
                            	<ul>
                                	<li>L1<li>
                                    <li>L2<li>
                                    <li>L3<li>
                                </ul>
                            </li>
                            <li>Q
                            	<ul>
                                    <li>Q1<li>
                                    <li>Q2<li>
                                    <li>Q3<li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li> S R 2</li>
                </ul>
            
            </li>
            <li><b>Sub Cat S2 </b></li>
            <li><b>Sub Cat S3 </b></li>
       </ul>
	</li>
    
    <li><span><strong>Category main M2</strong></span>
	   
	</li>
    
    <li><span><strong>Category main M3</strong></span>
	   
	</li>
    
    

</ul>
</div>

</div>
<?php include("footer.php"); ?>