<?= $this->extend("global/_pattern-backoffice") ?>

<?= $this->section("assets") ?>
<link rel="stylesheet" href="<?= base_url("assets/css/backoffice/projects.css") ?>">

<script src="<?= base_url("assets/js/backoffice/projects/global.js") ?>"></script>
<script src="<?= base_url("assets/js/backoffice/projects/projects.js") ?>"></script>
<script src="<?= base_url("assets/js/backoffice/projects/categories.js") ?>"></script>

<script src="<?= base_url("assets/libs/tinymce/tinymce.min.js") ?>" referrerpolicy="origin"></script>
<?= $this->endSection() ?>

<?= $this->section("main") ?>
<div class="slds-grid slds-grid_pull-padded-medium" style="width: 98%; margin: 20px auto auto;">
    <div class="slds-col slds-p-horizontal_medium">

        <div class="slds-grid slds-grid_vertical">
            <div class="slds-col">
                <div class="slds-card__header-title" style="display: flex; flex-direction: row; justify-content: space-between; padding: 10px; color: white;">
                    <div>
                        <h2 class="slds-text-heading_large">Projets</h2>
                    </div>
                    <div>
                        <button class="slds-button slds-button_icon slds-button_icon-brand" onclick="updateProjectsList()">
                            <svg class="slds-button__icon" aria-hidden="true">
                                <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#refresh"></use>
                            </svg>
                        </button>
                        <button class="slds-button slds-button_icon slds-button_icon-brand" onclick="showModalProject('add')">
                            <svg class="slds-button__icon" aria-hidden="true">
                                <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#add"></use>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <hr style="margin: 0;">
            <br>
            <div class="slds-col" style="background-color: white; padding: 10px; opacity: 0.75;">
                <table id="projects-datatable"></table>
            </div>
        </div>

    </div>
    <div class="slds-col slds-p-horizontal_medium">

        <div class="slds-grid slds-grid_vertical">
            <div class="slds-col">
                <div class="slds-card__header-title" style="display: flex; flex-direction: row; justify-content: space-between; padding: 10px; color: white;">
                    <div>
                        <h2 class="slds-text-heading_large">Catégories de projet</h2>
                    </div>
                    <div>
                        <button class="slds-button slds-button_icon slds-button_icon-brand" onclick="getCategoriesList()">
                            <svg class="slds-button__icon" aria-hidden="true">
                                <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#refresh"></use>
                            </svg>
                            <span class="slds-assistive-text">Actualiser</span>
                        </button>
                        <button class="slds-button slds-button_icon slds-button_icon-brand" onclick="showModalCategory('add')">
                            <svg class="slds-button__icon" aria-hidden="true">
                                <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#add"></use>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <hr style="margin: 0;">
            <br>
            <div class="slds-col" style="background-color: white; padding: 10px; opacity: 0.75;">
                <table id="types-datatable"></table>
            </div>
        </div>

    </div>
</div>

<div id="modal-project-action" style="display: none;">
    <section role="dialog" tabindex="-1" aria-modal="true" class="slds-modal slds-fade-in-open slds-modal_large">
        <div class="slds-modal__container">
            <button class="slds-button slds-button_icon slds-modal__close slds-button_icon-inverse" onclick="closeModalProject()">
                <svg class="slds-button__icon slds-button__icon_large" aria-hidden="true">
                    <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#close"></use>
                </svg>
            </button>
            <div class="slds-modal__header">
                <h1 class="slds-modal__title slds-hyphenate" id="modal-project-action_title">?</h1>
            </div>
            <div class="slds-modal__content slds-p-around_medium">
                <div class="slds-grid slds-grid_vertical">
                    <div class="slds-col">
                        <div class="slds-grid slds-gutters">
                            <div class="slds-col">
                                <div class="slds-form-element">
                                    <label class="slds-form-element__label" for="modal-project-action_form-title">
                                        Titre<abbr class="slds-required">*</abbr></label>
                                    <div class="slds-form-element__control">
                                        <input type="text" id="modal-project-action_form-title" class="slds-input" />
                                    </div>
                                </div>
                            </div>
                            <div class="slds-col">
                                <div class="slds-form-element">
                                    <label class="slds-form-element__label" for="modal-project-action_form-category">
                                        Catégorie<abbr class="slds-required">*</abbr></label>
                                    <div class="slds-form-element__control">
                                        <div class="slds-select_container">
                                            <select class="slds-select" id="modal-project-action_form-category"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slds-col">
                                <div class="slds-form-element">
                                    <label class="slds-checkbox_toggle slds-grid">
                                        <span class="slds-form-element__label slds-m-bottom_none">
                                            Statut<abbr class="slds-required">*</abbr></span>
                                        <input type="checkbox" id="modal-project-action_form-status"/>
                                        <span class="slds-checkbox_faux_container">
                                            <span class="slds-checkbox_faux"></span>
                                            <span class="slds-checkbox_on">Activer</span>
                                            <span class="slds-checkbox_off">Desactiver</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="slds-col">
                                <div class="slds-form-element">
                                    <span class="slds-form-element__label">Document</span>
                                    <div class="slds-form-element__control">  
                                        <div class="slds-file-selector slds-file-selector_files">
                                            <div class="slds-file-selector__dropzone">
                                                <input type="file" class="slds-file-selector__input slds-assistive-text" id="modal-project-action_form-file"/>
                                                <label class="slds-file-selector__body" for="modal-project-action_form-file">
                                                    <span class="slds-file-selector__button slds-button slds-button_neutral">
                                                    <svg class="slds-button__icon slds-button__icon_left" aria-hidden="true">
                                                    <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#upload"></use>
                                                    </svg>Télécharger le fichier</span>
                                                    <span class="slds-file-selector__text slds-medium-show">ou déposer le fichier</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="slds-col">
                        <textarea id="modal-project-action_form-texteditor"></textarea>
                    </div>
                </div>
            </div>
            <div class="slds-modal__footer">
                <button class="slds-button slds-button_neutral" onclick="closeModalProject()">Annuler</button>
                <button class="slds-button slds-button_brand" id="modal-project-action_valid">?</button>
            </div>
        </div>
    </section>
    <div class="slds-backdrop slds-backdrop_open"></div>
</div>

<div id="modal-category-action" style="display: none;">
    <section class="slds-modal slds-fade-in-open">
        <div class="slds-modal__container">
            <button class="slds-button slds-button_icon slds-modal__close slds-button_icon-inverse" onclick="closeModalCategory()">
                <svg class="slds-button__icon slds-button__icon_large" aria-hidden="true">
                    <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#close"></use>
                </svg>
            </button>
            <div class="slds-modal__header">
                <h1 class="slds-modal__title slds-hyphenate" id="modal-category-action_title">?</h1>
            </div>
            <div class="slds-modal__content slds-p-around_medium">
                <div id="modal-category-action_toast"></div>
                <div class="slds-form-element">
                    <label class="slds-form-element__label" for="modal-category-action_name">
                        Nom de la catégorie<abbr class="slds-required">*</abbr></label>
                    <div class="slds-form-element__control">
                        <input type="text" id="modal-category-action_name" class="slds-input">
                    </div>
                </div>
                <br>
                <div class="slds-form-element">
                    <label class="slds-checkbox_toggle slds-grid">
                        <span class="slds-form-element__label slds-m-bottom_none">Statut<abbr class="slds-required">*</abbr></span>
                        <br>
                        <input type="checkbox" id="modal-category-action_status" checked>
                        <span class="slds-checkbox_faux_container">
                            <span class="slds-checkbox_faux"></span>
                            <span class="slds-checkbox_on">Activer</span>
                            <span class="slds-checkbox_off">Désactiver</span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="slds-modal__footer">
                <button class="slds-button slds-button_neutral" onclick="closeModalCategory()">Annuler</button>
                <button class="slds-button slds-button_brand" id="modal-category-action_valid">?</button>
            </div>
        </div>
    </section>
    <div class="slds-backdrop slds-backdrop_open"></div>
</div>
<?= $this->endSection() ?>
