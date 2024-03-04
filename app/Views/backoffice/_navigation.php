<div class="slds-context-bar">
    <div class="slds-context-bar__primary">
        <div class="slds-context-bar__item slds-context-bar__dropdown-trigger slds-dropdown-trigger slds-dropdown-trigger_click slds-no-hover">
            <div class="slds-context-bar__icon-action">
                <button class="slds-button slds-icon-waffle_container slds-context-bar__button">
                    <span class="slds-icon-waffle">
                        <span class="slds-r1"></span>
                        <span class="slds-r2"></span>
                        <span class="slds-r3"></span>
                        <span class="slds-r4"></span>
                        <span class="slds-r5"></span>
                        <span class="slds-r6"></span>
                        <span class="slds-r7"></span>
                        <span class="slds-r8"></span>
                        <span class="slds-r9"></span>
                    </span>
                    <span class="slds-assistive-text"></span>
                </button>
            </div>
            <span class="slds-context-bar__label-action slds-context-bar__app-name">
                <span class="slds-truncate">PORTFOLIO</span>
            </span>
        </div>
    </div>
    <nav class="slds-context-bar__secondary" role="navigation">
        <ul class="slds-grid">
            <li class="slds-context-bar__item <?= $page == "BACKOFFICE-HOME" ? "slds-is-active" : "" ?>">
                <a href="<?= url_to("BACKOFFICE-HOME") ?>" class="slds-context-bar__label-action" title="Accueil">
                    <span class="slds-icon_container slds-icon-utility-announcement">
                        <svg class="slds-icon slds-icon-text-default" aria-hidden="true" style="width: 20px; margin-right: 5px;">
                            <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#home"></use>
                        </svg>
                    </span>
                    <span class="slds-truncate" title="Accueil">Accueil</span>
                </a>
            </li>
            <li class="slds-context-bar__item <?= $page == "BACKOFFICE-PROFILE" ? "slds-is-active" : "" ?>">
                <a href="<?= url_to("BACKOFFICE-PROFILE") ?>" class="slds-context-bar__label-action" title="Profil">
                    <span class="slds-icon_container slds-icon-utility-announcement">
                        <svg class="slds-icon slds-icon-text-default" aria-hidden="true" style="width: 20px; margin-right: 5px;">
                            <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#identity"></use>
                        </svg>
                    </span>
                    <span class="slds-truncate" title="Profil">Profil</span>
                </a>
            </li>
            <li class="slds-context-bar__item <?= $page == "BACKOFFICE-PROJECTS" ? "slds-is-active" : "" ?>">
                <a href="<?= url_to("BACKOFFICE-PROJECTS") ?>" class="slds-context-bar__label-action" title="Projets">
                    <span class="slds-icon_container slds-icon-utility-announcement">
                        <svg class="slds-icon slds-icon-text-default" aria-hidden="true" style="width: 20px; margin-right: 5px;">
                            <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#page"></use>
                        </svg>
                    </span>
                    <span class="slds-truncate" title="Projets">Projets</span>
                </a>
            </li>
            <li class="slds-context-bar__item <?= $page == "BACKOFFICE-TECHWATCH" ? "slds-is-active" : "" ?>">
                <a href="<?= url_to("BACKOFFICE-TECHWATCH") ?>" class="slds-context-bar__label-action" title="Veille technologique">
                    <span class="slds-icon_container slds-icon-utility-announcement">
                        <svg class="slds-icon slds-icon-text-default" aria-hidden="true" style="width: 20px; margin-right: 5px;">
                            <use xlink:href="/assets/resources/icons/utility-sprite/svg/symbols.svg#link"></use>
                        </svg>
                    </span>
                    <span class="slds-truncate" title="Veille technologique">Veille technologique</span>
                </a>
            </li>

            <li class="slds-context-bar__item">
                <div class="slds-dropdown-trigger slds-dropdown-trigger_click">
                    <button class="slds-button slds-global-actions__avatar slds-global-actions__item-action" title="person name" aria-haspopup="true">
                        <span class="slds-avatar slds-avatar_circle slds-avatar_medium">
                            <img alt="Person name" src="/assets/resources/images/avatar2.jpg"/>
                        </span>
                    </button>
                </div>
            </li>

        </ul>
    </nav>
</div>