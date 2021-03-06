{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblMenu|ucfirst}: {$lblEdit}</h2>
</div>

{form:edit}
    <label for="title">{$lblTitle|ucfirst}</label>
    {$txtTitle} {$txtTitleError}

    <div id="pageUrl">
        <div class="oneLiner">
            {option:detailURL}<p><span><a href="{$detailURL}/{$item.url}">{$detailURL}/<span id="generatedUrl">{$item.url}</span></a></span></p>{/option:detailURL}
            {option:!detailURL}<p class="infoMessage">{$errNoModuleLinked}</p>{/option:!detailURL}
        </div>
    </div>


    <div class="tabs">
        <ul>
            <li><a href="#tabContent">{$lblContent|ucfirst}</a></li>
            {*<li><a href="#tabSEO">{$lblSEO|ucfirst}</a></li>*}
        </ul>

        <div id="tabContent">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <td id="leftColumn">

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="description">{$lblDescription|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
                                </h3>
                            </div>
                            <div class="optionsRTE">
                                {$txtDescription} {$txtDescriptionError}
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="price">{$lblPrice|ucfirst}</label>
                                </h3>
                            </div>
                            <div class="optionsRTE">
                                {$txtPrice} {$txtPriceError}
                            </div>
                        </div>


                    </td>

                    <td id="sidebar">


                        <div class="box">
                            <div class="heading">
                                <h3>
                                    {$lblHidden|ucfirst}
                                </h3>
                            </div>
                            <div class="options">
                                <ul class="inputList">
                                    {iteration:hidden}
                                        <li>
                                            {$hidden.rbtHidden}
                                            <label for="{$hidden.id}">{$hidden.label}</label>
                                        </li>
                                    {/iteration:hidden}
                                </ul>
                            </div>
                        </div>


                    </td>
                </tr>
            </table>
        </div>

        {*<div id="tabSEO">*}
            {*{include:{$BACKEND_CORE_PATH}/layout/templates/seo.tpl}*}
        {*</div>*}

    </div>

    <div class="fullwidthOptions">
        <a href="{$var|geturl:'delete'}&amp;id={$item.id}" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
            <span>{$lblDelete|ucfirst}</span>
        </a>
        <div class="buttonHolderRight">
            <input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="{$lblSave|ucfirst}" />
        </div>
    </div>

    <div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
        <p>
            {$msgConfirmDelete|sprintf:{$item.title}}
        </p>
    </div>
{/form:edit}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}
