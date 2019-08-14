<?php

/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

$scriptSrc = $view['assets']->getUrl('media/js/'.($app->getEnvironment() == 'dev' ? 'mautic-form-src.js' : 'mautic-form.js'), null, null, true);
$scriptSrc = str_replace('/index_dev.php', '', $scriptSrc);
?>

<script type="text/javascript">
    /** This section is only needed once per page if manually copying **/
    if (typeof MauticSDKLoaded == 'undefined') {
        var MauticSDKLoaded = true;
        var head            = document.getElementsByTagName('head')[0];
        var script          = document.createElement('script');
        script.type         = 'text/javascript';
        script.src          = '<?php echo $scriptSrc; ?>';
        script.onload       = function() {
            MauticSDK.onLoad();
        };
        head.appendChild(script);
        var MauticDomain = '<?php echo str_replace('/index_dev.php', '', $view['assets']->getBaseUrl()); ?>';
        var MauticLang   = {
            'submittingMessage': "<?php echo $view['translator']->trans('mautic.form.submission.pleasewait'); ?>"
        }
    }
    function capitalizeName(text) {
        var words = text.toLowerCase().split(" ");
        for (var a = 0; a < words.length; a++) {
            var w = words[a];
            words[a] = w[0].toUpperCase() + w.slice(1);
        }
        return words.join(" ");
    }

    // auto-format name field
    var pn = document.getElementsByName('mauticform[primeiro_nome]');
    var sn = document.getElementsByName('mauticform[sobrenome]');
    
    pn[0].onblur = function(){pn[0].value=capitalizeName(pn[0].value)}
    sn[0].onblur = function(){sn[0].value=capitalizeName(sn[0].value)}

    //translate form
    var translations = {
        "pt":"pt",
        "es":"es",
        "en":"en",
        "primeiro_nome": {
            "pt":"Nome",
            "es":"Nombre",
            "en":"Fistname"
        },
        "telefone": {
            "pt":"Telefone",
            "es":"Telefono",
            "en":"Phone"
        },
        "empresa": {
            "pt":"Empresa",
            "es":"Empresa",
            "en":"Company"
        },
        "como_conheceu_a_teknisa": {
            "pt":"Como Conheceu?",
            "es":"¿Cómo conociste a Teknisa?",
            "en":"How did you find Teknisa?"
        },
        " Redes Sociais":{
            "pt":" Redes Sociais",
            "es":" Redes Sociales",
            "en":" Social Networks"
        },
        " Indicação":{
            "pt":" Indicação",
            "es":" Indicación",
            "en":" Referral"
        },
        " Eventos":{
            "pt":" Eventos",
            "es":" Eventos",
            "en":" Events"
        },
        " Jornal/Revista":{
            "pt":" Jornal/Revista",
            "es":" Periódico/Revista",
            "en":" Newspaper/Magazines"
        },
        " Outros":{
            "pt":" Outros",
            "es":" Otros",
            "en":" Others"
        },
        "deixe_sua_mensagem_aqui":{
            "pt":"Deixe sua mensagem aqui",
            "es":"Deja tu mensaje aqui",
            "en":"Leave your message here"
        },                    
        "Enviar":{
            "pt":"Enviar",
            "es":"Enviar",
            "en":"Submit"
        }
    }

    var a = document.querySelectorAll("[data-validate]");
    var lang = document.documentElement.lang.slice(0, 2);

    for (var t = 0; t < a.length ;t++)
    {
        if (a[t])
        {
            html = a[t].innerHTML;
            attribute = a[t].getAttribute("data-validate");
            if (lang != null &&  translations.hasOwnProperty(lang) && translations.hasOwnProperty(attribute)) 
            {                
                if (a[t].className.match(/mauticform-radiogrp/g))
                {
                    options = a[t].getElementsByClassName('mauticform-radiogrp-label');
                    for (var r = 0; r < options.length; r++)
                    {
                        if (translations[options[r].innerText]) {
                            options[r].innerHTML = options[r].innerHTML.replace(translations[options[r].innerText].pt,translations[options[r].innerText][lang]);
                        }
                    }
                }
                else 
                { 
                    a[t].innerHTML = a[t].innerHTML.replace(translations[attribute].pt,translations[attribute][lang]);
                }
            }
        }
    }
}    
</script>
