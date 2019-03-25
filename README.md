# OxidScripts

Dieses Modul ist für Entwickler, die mit Webpack oder Ähnlichem arbeiten und alle Dateien uglifien/minimizen. Dazu kommt vermutlich NodeJS (npm) zum einsatz. Hier werden alle Scripts wie jQuery, jQuery UI, photoswipe oder Bootstrap per npm geladen. Alle .js Dateien in Modulen werden von Webpack automatisch gecrawlt und eingebunden. Zusätzlich durchsucht Webpack die Ordner vendor und js des aktiven Themes nach Dateien und ggf. auch die des Vater-Themes.

Webpack sollte nun die Datei `/out/AKTIVES_THEME/js/scripts.min.js` anlegen, diese kann im Template dann mit `[{oxscript include="js/scripts.min.js?masterscript=1" priority="1"}]` eingebunden werden.

`masterscript=1` teil diesem Modul mit, dass lediglich nur eine include-Datei eingebunden werden soll. Alle anderen Dateien werden automatisch ignoriert, da diese ja bereits per Webpack geladen wurden.

**Hinweis:** Dieses Modul übernimmt keine Webpack/NPM konfiguration.




## Anwendung

First of all: Füge `<script>var oxTemplateCallbacks = [];</script>` vor dem schließenden </head>-Tag in deinem Template ein.

Der Tag befindet i.d.R. sich unter `source/Application/views/AKTIVES THEME/tpl/layout/base.tpl`.

Im Block `base_js` weiter unten könnte dann das Masterscript von Webpack geladen werden:

```
[{block name="base_js"}]
    [{oxscript include="js/scripts.min.js?masterscript=1" priority="1"}]
[{/block}]
```
