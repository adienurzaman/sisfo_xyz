
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$this->load->view('layout/head');
	?>
</head>
<body class="footer_fixed" style="background-color:#eaeaea;">
	<div class="container body">
		<div class="main_container">
			<div class="col-sm left_col menu_fixed">
				<div class="left_col scroll-view">
				</div>
			</div>
			<?php if($sess_location!='Welcome Page'){ ?>
				<div class="navbar nav_title" style="border: 0;">
					<a href="<?php echo base_url('backend/welcome'); ?>" class="site_title"><img src="<?php echo base_url('build/img/xyz_2.png');?>" height="48" class="img img-rounded">
						<?php if($session['level_user']=='Operator'){?>
							<span> | CAB-<?php echo '['.$session['id_cabang'].']';?></span>
						<?php }else{?>
							<span> | XYZ</span>
						<?php } ?>
					</a>
				</div>
				<?php 
			} 
			?>
			<?php
		//atas
			if($sess_location!='Welcome Page'){
				$this->load->view('layout/topnavigation');
			}else{
			//NULL
			}
			?>
			<div class="container">
				<?php 
		//isilaman
				$this->load->view('laman/' . $tampilan);
				?>
				<div class="clearfix"></div>
			</div>
			<br/>
			<?php
			if($sess_location!='Welcome Page'){
		//bawah
				$this->load->view('layout/footer');
			}else{
			//NULL
			}
			?>
		</div>
	</div>
	<?php
	$this->load->view('layout/footer_js');
	?>

	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script>
		var OneSignal = window.OneSignal || [];
		OneSignal.push(function() {
			OneSignal.init({
				appId: "ceb65919-9e25-4c49-a38a-4f137dc2826f",
				promptOptions: {
					/* These prompt options values configure both the HTTP prompt and the HTTP popup. */
					/* actionMessage limited to 90 characters */
					actionMessage: "Pilih Izinkan untuk menerima notifikasi.",
					/* acceptButtonText limited to 15 characters */
					acceptButtonText: "Izinkan",
					/* cancelButtonText limited to 15 characters */
					cancelButtonText: "Batal"
				}
			});
			OneSignal.showSlidedownPrompt();
		});
	</script>
	<script type="text/javascript">
		function subscribe() {
			OneSignal.push(["registerForPushNotifications"]);
			event.preventDefault();
		}

		function unsubscribe() {
			OneSignal.setSubscription(true);
		}

		var OneSignal = window.OneSignal || [];
		var username = "<?php echo $session['username']; ?>";
		var id_user = "<?php echo $session['id_user']; ?>";
		var id_cabang = "<?php echo $session['id_cabang'];?>";
		var id_lapangan = "<?php echo $session['id_lapangan'];?>";
		var jabatan = "<?php echo $session['jabatan'];?>";
		var id_cab;
		var id_lap;
		if(id_cabang == ""){
			id_cab = "0";
			id_lap = "0";
		}else{
			id_cab = id_cabang;
			id_lap = id_lapangan;
		}
		var level_user = "<?php echo $session['level_user'];?>";
		console.log("ID User : ",id_user);
		console.log("ID Cabang : ",id_cab);
		console.log("ID Lapangan : ",id_lap);
		console.log("Level User : ",level_user);
		OneSignal.push(function() {
			/* These examples are all valid */
		    // Occurs when the user's subscription changes to a new value.
		    OneSignal.on('subscriptionChange', function (isSubscribed) {
		    	console.log("The user's subscription state is now:", isSubscribed);
		    	OneSignal.sendTags({
		    		id_user:id_user, 
		    		id_cabang:id_cab, 
		    		id_lapangan:id_lap, 
		    		level_user:level_user,
		    		jabatan:jabatan,
		    	}, function(tagsSent){
		            // Callback called when tags have finished sending
		            console.log("Semua Tags berhasil dikirimkan!");
		        });
		    });
		    /* These examples are all valid */
		    var isPushSupported = OneSignal.isPushNotificationsSupported();
		    if (isPushSupported) {
		      // Push notifications are supported
		      console.log("Push Notif Supported");
		      OneSignal.isPushNotificationsEnabled(function(isEnabled) {
		      	if (isEnabled){
		      		console.log("Push notifications are enabled!");
		      		OneSignal.sendTags({
		      			id_user:id_user, 
			    		id_cabang:id_cab, 
			    		id_lapangan:id_lap, 
			    		level_user:level_user,
			    		jabatan:jabatan,
		      		}, function(tagsSent){
		            // Callback called when tags have finished sending
		            console.log("Semua Tags berhasil diperbaharui!");
		        });
		      	}
		      	else{
		      		console.log("Push notifications are not enabled yet.");   
		      		OneSignal.push(function() {
		      			OneSignal.showSlidedownPrompt();
		      		}); 
		      	}
		      });
		  } else {
		      // Push notifications are not supported
		      alert("Push Notif Unsupported");
		  }
		});
	</script>
</body>
</html>

