<?= $this->extend("backoffice/_pattern") ?>

<?= $this->section("assets") ?>
<link rel="stylesheet" href="<?= base_url("assets/css/backoffice/login.css") ?>">
<?= $this->endSection() ?>

<?= $this->section("main") ?>
<form action="/login" method="post">
    <div class="slds-box" style="width: 30%; min-width: 300px; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); background-color: white;">
        <div class="slds-box__header slds-text-align_center">
            <span class="slds-icon_container slds-icon_container_circle slds-icon-action-description">
                <svg class="slds-icon" aria-hidden="true">
                    <use xlink:href="/assets/resources/icons/action-sprite/svg/symbols.svg#user"></use>
                </svg>
            </span>
        </div>
        <?php if (!empty($message)) {  ?>
            <br>
            <div class="slds-scoped-notification slds-media slds-media_center slds-theme_error" role="status">
                <div class="slds-media__figure">
                    <span class="slds-icon_container slds-icon-utility-error">
                        <svg class="slds-icon slds-icon_small" aria-hidden="true">
                            <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#error"></use>
                        </svg>
                        <span class="slds-assistive-text">error</span>
                    </span>
                </div>
                <div class="slds-media__body">
                    <p><?= $message ?></p>
                </div>
            </div>
        <?php } ?>
        <div class="slds-box__body">
            <div class="slds-form-element slds-p-vertical_large">
                <label class="slds-form-element__label" for="text-input-id-1">Nom d'utilisateur</label>
                <div class="slds-form-element__control">
                    <input type="text" id="username" class="slds-input">
                </div>
            </div>
            <div class="slds-form-element slds-p-vertical_large">
                <label class="slds-form-element__label" for="text-input-id-1">Mot de passe</label>
                <div class="slds-form-element__control">
                    <input type="password" id="password" class="slds-input">
                </div>
            </div>
            <div class="slds-form-element slds-p-vertical_large">
                <div class="slds-form-element__control">
                    <button class="slds-button slds-button_brand" id="submit">Connexion</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>
