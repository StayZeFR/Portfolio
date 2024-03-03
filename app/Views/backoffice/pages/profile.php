<?= $this->extend("backoffice/_pattern") ?>

<?= $this->section("assets") ?>
<link rel="stylesheet" href="<?= base_url("assets/css/backoffice/profile.css") ?>">
<script src="<?= base_url("assets/js/backoffice/profile.js") ?>"></script>

<script src="<?= base_url("assets/libs/tinymce/tinymce.min.js") ?>" referrerpolicy="origin"></script>
<?= $this->endSection() ?>

<?= $this->section("main") ?>
<div class="slds-grid slds-grid_pull-padded-medium slds-wrap" style="width: 98%; margin: 20px auto auto;">
    <div class="slds-grid slds-grid_vertical" style="width: 100%;">
        <div class="slds-col">
            <div class="slds-card__header-title"
                 style="display: flex; flex-direction: row; justify-content: space-between; padding: 10px; color: white;">
                <div>
                    <h2 class="slds-text-heading_large">Profil</h2>
                </div>
                <div>

                </div>
            </div>
        </div>
        <hr style="margin: 0;">
        <br>
        <div class="slds-col" style="background-color: white; padding: 20px; opacity: 0.75;">
            <div class="slds-grid slds-grid_vertical" style="width: 100%;">
                <div class="slds-col">
                    <div class="slds-grid slds-gutters slds-wrap">
                        <div class="slds-col">
                            <div id="profile-icon" style="width: 200px; height: 200px; border-radius: 50%; margin: auto; opacity: 1;">
                            </div>
                        </div>
                        <div class="slds-col">
                            <div class="slds-grid slds-grid_vertical" style="height: 100% !important;">
                                <div class="slds-col">
                                    <div class="slds-grid slds-gutters slds-wrap" style="height: 100% !important;">
                                        <div class="slds-col">
                                            <div class="slds-grid slds-grid_vertical" style="height: 100% !important;">
                                                <div class="slds-col" style="width: 100%;">
                                                    <div class="slds-form-element">
                                                        <label class="slds-form-element__label" for="input_firstname">Prénom</label>
                                                        <div class="slds-form-element__control">
                                                            <input type="text" id="input_firstname" class="slds-input input_profile" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="slds-col" style="width: 100%;">
                                                    <label for="input_logo" class="slds-form-element__label">Logo (PNG)</label>
                                                    <br>
                                                    <div id="input_logo-content">
                                                        <input type="file" id="input_logo" class="input-file_profile" style="width: 100%;" accept="image/png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slds-col">
                                            <div class="slds-grid slds-grid_vertical" style="height: 100% !important;">
                                                <div class="slds-col" style="width: 100%;">
                                                    <div class="slds-form-element">
                                                        <label class="slds-form-element__label" for="input_lastname">Nom</label>
                                                        <div class="slds-form-element__control">
                                                            <input type="text" id="input_lastname" class="slds-input input_profile" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="slds-col" style="width: 100%;">
                                                    <label for="input_cv" class="slds-form-element__label">CV (PDF)</label>
                                                    <br>
                                                    <div id="input_cv-content">
                                                        <input type="file" id="input_cv" class="input-file_profile" style="width: 100%;" accept="application/pdf">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slds-col">
                                            <div class="slds-grid slds-grid_vertical" style="height: 100% !important;">
                                                <div class="slds-col" style="width: 100%;">
                                                    <div class="slds-form-element">
                                                        <label class="slds-form-element__label" for="input_mail">Adresse mail</label>
                                                        <div class="slds-form-element__control">
                                                            <input type="text" id="input_mail" class="slds-input input_profile" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="slds-col" style="width: 100%;">
                                                    <label for="input_ts" class="slds-form-element__label">Tableau de synthèse (PDF)</label>
                                                    <br>
                                                    <div id="input_ts-content">
                                                        <input type="file" id="input_ts" class="input-file_profile" style="width: 100%;" accept="application/pdf">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="input_description">Description</label>
                                        <div class="slds-form-element__control">
                                            <div id="input_description" style="min-height: 100px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slds-col" id="input_button" style="margin-top: 20px; display: flex; flex-direction: row; justify-content: right;">
                                    <button class="slds-button slds-button_neutral" id="btn_cancel" disabled onclick="cancel()">Annuler</button>
                                    <button class="slds-button slds-button_brand" id="btn_save" disabled onclick="save()">Sauvegarder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
