<?= $this->extend("backoffice/_pattern") ?>

<?= $this->section("assets") ?>
<link rel="stylesheet" href="<?= base_url("assets/css/backoffice/techwatch.css") ?>">
<script src="<?= base_url("assets/js/backoffice/techwatch.js") ?>"></script>
<script src="<?= base_url("assets/libs/tinymce/tinymce.min.js") ?>" referrerpolicy="origin"></script>
<?= $this->endSection() ?>

<?= $this->section("main") ?>
<div class="slds-grid slds-grid_pull-padded-medium slds-wrap" style="width: 98%; margin: 20px auto auto;">
    <div class="slds-grid slds-grid_vertical" style="width: 100%;">
        <div class="slds-col">
            <div class="slds-card__header-title"
                 style="display: flex; flex-direction: row; justify-content: space-between; padding: 10px; color: white;">
                <div>
                    <h2 class="slds-text-heading_large">Veille technologique</h2>
                </div>
                <div>

                </div>
            </div>
        </div>
        <hr style="margin: 0;">
        <br>
        <div class="slds-col" style="background-color: white; padding: 20px; opacity: 0.75;">
            <div class="slds-grid slds-grid_vertical">
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
                <hr>
                <div class="slds-col" style="margin-bottom: 20px; display: flex; flex-direction: row; justify-content: space-between;">
                    <div>
                        <h3 class="slds-text-heading_medium">Flux RSS</h3>
                    </div>
                    <div class="slds-grid slds-gutters">
                        <div class="slds-col">
                            <div class="slds-form-element">
                                <label class="slds-checkbox_toggle slds-grid">
                                    <input id="input_status" type="checkbox" checked>
                                    <span class="slds-checkbox_faux_container">
                                        <span class="slds-checkbox_faux"></span>
                                        <span class="slds-checkbox_on">Activer</span>
                                        <span class="slds-checkbox_off">Desactiver</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="slds-col">
                            <button class="slds-button slds-button_icon slds-button_icon-brand" onclick="updateLinks()">
                                <svg class="slds-button__icon" aria-hidden="true">
                                    <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#refresh"></use>
                                </svg>
                                <span class="slds-assistive-text">Actualiser</span>
                            </button>
                        </div>
                        <div class="slds-col">
                            <button class="slds-button slds-button_icon slds-button_icon-brand"
                                    onclick="showModalLink('add')">
                                <svg class="slds-button__icon" aria-hidden="true">
                                    <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#add"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slds-col">
                    <table id="table_links"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
