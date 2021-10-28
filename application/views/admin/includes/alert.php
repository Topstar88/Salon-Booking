<?php if(isset($alert) || $alert = $this->session->flashdata('alert')) { ?>
    <div class="<?php echo esc($alert['type']) ?>">
        <span><?php echo esc($alert['msg']); ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<div class="alert alert-danger" id="somethngwrng" style="display:none">Script tag in fields not allowed.</div>