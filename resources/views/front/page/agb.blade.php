@extends('front.layouts.app')

@section('meta_title','AGB\'s')
@section('meta_description','AGB\'s')

@section('styles')
{{-- <link rel="stylesheet" href="{{ asset('front/assets/css/order.css?ver=' . str_random(10)) }}"> --}}
@endsection

@section('content')
<main>
	<div class="container">
		<ul class="b-crumbs">
			<li>
				<a href="{{ route('home') }}">
					Home
				</a>
			</li>
			<li>
				AGB's
			</li>
		</ul>
		<div class="agb-s">
			<h1 style="text-indent: 0cm; margin: 0cm 0cm 14.0pt 0cm;"><span style="font-family: Calibri;">AGB</span></h1>
			<p><strong><span style="font-size: 11.0pt; font-family: Calibri;">Allgemeine Gesch&auml;ftsbedingungen der</span></strong><strong><span style="font-size: 11.0pt; font-family: Calibri;"> centrocaffe.ch Pietro Fruci</span></strong></p>
			<ol start="1">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Allgemeines</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Alle Leistungen, die vom Onlineshop f&uuml;r den Kunden erbracht werden, erfolgen ausschlie&szlig;lich auf der Grundlage der nachfolgenden Allgemeinen Gesch&auml;ftsbedingungen. Abweichende Regelungen haben nur dann Geltung, wenn sie zwischen Onlineshop und Kunde schriftlich vereinbart wurden.&nbsp;Der Kunde erkennt mit seiner Bestellung diese Allgemeinen Gesch&auml;ftsbedingungen ausdr&uuml;cklich an.</span></p>
			<ol start="2">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Vertragsschluss</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Zum Vertragsschluss mit dem Onlineshop sind nur Personen berechtigt, die das 18. Lebensjahr vollendet haben und zum Zeitpunkt des Vertragsschlusses in ihrer Gesch&auml;ftsf&auml;higkeit nicht beschr&auml;nkt sind. Wir verkaufen nur in handels&uuml;bligen Mengen.&nbsp;Die Angebote des Onlineshops im Internet sind eine unverbindliche Offerte an den Kunden, im Onlineshop Waren zu bestellen.&nbsp;Durch die Bestellung von Waren des Onlineshops im Internet gibt der Kunde ein verbindliches Anbot auf Abschluss eines Kaufvertrages ab.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Der Onlineshop ist berechtigt, dieses Angebot innerhalb von 14 Kalendertagen durch Zusendung einer Auftragsbest&auml;tigung anzunehmen. Die Auftragsbest&auml;tigung erfolgt durch &Uuml;bermittlung einer Email.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Wir sind frei zu entscheiden ob wir eine Bestellung annehmen. Falls wir eine Bestellung nicht ausf&uuml;hren werden, teilen wir das dem Kunden unverz&uuml;glich mit.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Falls ein Produkt nicht mehr verf&uuml;gbar ist, teilen wir das dem Kunden ebenfalls unverz&uuml;glich mit. In dem Fall kommt keinen Vertrag zustande.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Die Bestellbest&auml;tigung die dem Kunden unmittelbar nach der Bestellung automatisch zugeschickt wird, wie auch die Entgegennahme einer telefonischen Bestellung, stellen noch keine rechtsgesch&auml;ftliche Annahme unsererseits dar. Die automatische E-Mailbenachrichtigung gilt lediglich als Eingangsbest&auml;tigung.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Nach unbeantwortetem Ablauf der 14-Tages-Frist gilt das Angebot als abgelehnt.</span></p>
			<ol start="3">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> R&uuml;cktrittsrecht</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">3.1 Der Kunde ist berechtigt von dem Vertrag zur&uuml;ck zu treten oder die Waren aus zu tauschen innerhalb von HINWEIS: mindestens zehn Werktagen ab dem Eingang der Waren beim Kunden.&nbsp;Es gen&uuml;gt, wenn die R&uuml;cktrittserkl&auml;rung innerhalb der Frist abgesendet wird.&nbsp;Der Onlineshop&nbsp;&uuml;bernimmt die Portokosten und das Gefahr nicht.&nbsp;Die R&uuml;cksandadresse lautet:</span><span style="font-size: 11.0pt; font-family: Calibri;"> centrocaffe.ch Pietro Fruci</span><span style="font-size: 11.0pt; font-family: Calibri;">, </span><span style="font-size: 11.0pt; font-family: Calibri;">Althard</span><span style="font-size: 11.0pt; font-family: Calibri;">strasse </span><span style="font-size: 11.0pt; font-family: Calibri;">160</span><span style="font-size: 11.0pt; font-family: Calibri;">, CH-</span><span style="font-size: 11.0pt; font-family: Calibri;">8105 Regensdorf</span><span style="font-size: 11.0pt; font-family: Calibri;"> ZH</span><span style="font-size: 11.0pt; font-family: Calibri;">.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">3.2 Im Fall eines R&uuml;cktritts vom Ankauf, wird der Onlineshop gegebenenfalls schon erfolgte Bezahlungen dem Kunden r&uuml;ckerstatten innerhalb von 14</span> <span style="font-size: 11.0pt; font-family: Calibri;">Tagen.&nbsp;Der Kunde hat die empfangenen Leistungen zur&uuml;ckzustellen auf eigenen Kosten, und dem Onlineshop ein angemessenes Entgelt f&uuml;r die Ben&uuml;tzung, einschlie&szlig;lich einer Entsch&auml;digung f&uuml;r eine damit verbundene Minderung des gemeinen Wertes der Leistung, zu zahlen. Dies gilt jedoch nicht, wenn die Verschlechterung der Ware ausschlie&szlig;lich auf deren Pr&uuml;fung zur&uuml;ckzuf&uuml;hren ist.&nbsp;Ist die R&uuml;ckstellung der vom Onlineshop bereits erbrachten Leistungen unm&ouml;glich oder untunlich, so hat der Kunde dem Onlineshop deren Wert zu verg&uuml;ten, soweit sie ihm zum klaren und &uuml;berwiegenden Vorteil gereichen.&nbsp;Die Bestimmungen dieses Absatzes lassen Schadenersatzanspr&uuml;che unber&uuml;hrt.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">3.3 Von dem R&uuml;cktrittsrecht sind ausgenommen, Vertr&auml;ge &uuml;ber:<br />Waren die auf Grund ihrer Beschaffenheit oder wegen hygienischen Grunden nicht f&uuml;r eine R&uuml;cksendung geeignet sind, die schnell verderben k&ouml;nnen oder deren Verfallsdatum &uuml;berschritten w&uuml;rde</span></p>
			<ol start="4">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Lieferung</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">4.1 Alle Artikel werden umgehend, sofern ab Lager verf&uuml;gbar und nur solange der Vorrat reicht, ausgeliefert, unter Voraussetzung einer erfolgreichen Identit&auml;ts- und Bonit&auml;tspr&uuml;fung.<br />Die Lieferung erfolgt nur innerhalb der Schweiz.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">4.2 Die Lieferzeit innerhalb der Schweiz betr&auml;gt, sofern nicht beim Angebot anders angegeben, maximal 5 Werktage.<br />Die Lieferzeit beginnt mit dem Versand der Auftragsbest&auml;tigung. Die Angabe der Lieferzeit ist unverbindlich, es sei denn, es gibt eine anders lautende schriftliche Vereinbarung.<br />Sollte ein Artikel kurzfristig nicht verf&uuml;gbar sein, informieren wir dem Kunden schnellstm&ouml;glich per E-Mail &uuml;ber die zu erwartende Lieferzeit, sofern uns eine Adresse vorliegt. Wir behalten uns das Recht einer Teillieferung vor, insoweit dies eine effiziente Abwicklung der Gesamtlieferung dient. F&uuml;r die Nachlieferung werden in dem Fall keine zus&auml;tzliche Versandkosten f&auml;llig.<br />Bei Lieferungsverz&ouml;gerungen, wie z.B. durch h&ouml;here Gewalt, Verkehrsst&ouml;rungen und Verf&uuml;gungen von hoher Hand sowie sonstige von dem Onlineshop nicht zu vertretende Ereignisse, kann kein Schadenersatzanspruch gegen den Onlineshop geltend gemacht werden.<br />Ist die Lieferung durch das Verschulden von Vorlieferanten verz&ouml;gert und unterblieben (Unm&ouml;glichkeit), so hat der Onlineshop daf&uuml;r nicht einzustehen.</span></p>
			<ol start="5">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Verpackung- und Versendung von Waren</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">5.1 Wie bieten die folgenden Versandarten an:&ensp;&ensp;&ensp;<br />den im Angebot festgelegten Versandpreis. Bei jeder Bestellung werden die Versandkosten separat ausgewiesen und mitgeteilt.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">5.2 Bei Bestellungen mit einem Bestellwert &uuml;ber CHF 100.- liefern wir innerhalb der Schweiz versandkostenfrei.&nbsp;</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">5.3 Auf Wunsch des Kunden k&ouml;nnen auch Eillieferungen durchgef&uuml;hrt werden. Die dabei entstehenden zus&auml;tzlichen Kosten tr&auml;gt der Kunde.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">5.4 Auf Kosten des Kunden wird eine Transportversicherung abgeschlossen. Transportsch&auml;den sind unverz&uuml;glich dem Zusteller zu melden.</span></p>
			<ol start="6">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Preise</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">6.1 Alle angegebenen Preise sind ohne </span><span style="font-size: 11.0pt; font-family: Calibri;">die</span><span style="font-size: 11.0pt; font-family: Calibri;"> gesetzliche Mehrwertsteuer.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">6.2 Die Endpreise inkludieren nicht die Kosten f&uuml;r Verpackung und Versand.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">6.3 Durch die st&auml;ndige Aktualisierung der Internetseiten des Onlineshops, verlieren zu einem fr&uuml;heren Zeitpunkt gemachte Angaben bez&uuml;glich Preis und Beschaffenheit der Waren ihre G&uuml;ltigkeit. Irrt&uuml;mer und Druckfehler bleiben vorbehalten.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">6.4 Der ausgewiesene Preis zum Zeitpunkt der Abgabe des Angebots des Kunden ist f&uuml;r die Rechnungsstellung ma&szlig;geblich.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">6.5 Zoll und Umsatzsteuer f&uuml;r Waren, die ins EU-Ausland versandt wurden, hat der K&auml;ufer selbst sorge zu tragen. die Waren werden in diesem fall umsatzsteuerfrei geliefert und die Preise verstehen sich ohne Zoll und Umsatzsteuer.</span></p>
			<ol start="7">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Zahlung</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Bei Lieferung innerhalb der Schweiz sind folgende Zahlweisen m&ouml;glich:</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">per Kreditkarte,&nbsp;Abbuchung erfolgt nach Versenden der Ware; zul&auml;ssig sind folgende Kreditkarten:<br />Euro/Mastercard,&nbsp;Visa</span><span style="font-size: 11.0pt; font-family: Calibri;">, American Express.</span></p>
			<ol start="8">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Eigentumsvorbehalt von Waren</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Bis zur vollst&auml;ndigen Bezahlung bleiben die bestellten Waren Eigentum des Onlineshops (Eigentumsvorbehalt). Bei Zahlungsverzug des Kunden ist der Onlineshop berechtigt, die Ware zur&uuml;ckzunehmen. Darin liegt kein R&uuml;cktritt vom Vertrag, es sei denn dieser wird ausdr&uuml;cklich erkl&auml;rt.<br />&Uuml;ber Zwangsvollstreckungsma&szlig;nahmen Dritter in die Vorbehaltsware hat uns der Kunde unverz&uuml;glich unter &Uuml;bergabe der f&uuml;r eine Intervention notwendigen Unterlagen zu unterrichten; dies gilt auch f&uuml;r Beeintr&auml;chtigungen sonstiger Art. Unabh&auml;ngig davon hat der Kunde bereits im Vorhinein die Dritten auf die an der Ware bestehenden Rechte hinzuweisen.</span></p>
			<ol start="9">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Gew&auml;hrleistung f&uuml;r M&auml;ngel bei Waren</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">9.1 Die aus einem Mangel der Ware begr&uuml;ndeten Anspr&uuml;che des Kunden gegen den Onlineshop richten sich nach den gesetzlichen Vorschriften.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">9.2 Der Kunde verpflichtet sich, die Ware bei Entgegennahme auf etwaige M&auml;ngel zu untersuchen und bei Feststellung eines solchen umgehend den Onlineshop dar&uuml;ber in Kenntnis zu setzen. Sollte der Kunde zu einem sp&auml;teren Zeitpunkt feststellen, dass die Ware mangelhaft ist, so ist er verpflichtet, den Onlineshop sofort nach Entdeckung desselben zu informieren. Unterl&auml;sst es der Kunde, einen Mangel anzuzeigen, gilt die Ware als genehmigt.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">9.3 Als Mangel an der Ware z&auml;hlen nicht Sch&auml;den, die der Kunde durch unsachgem&auml;&szlig;e oder vertragswidrige Behandlung verursacht hat. Ausschlaggebend f&uuml;r die Unsachgem&auml;&szlig;heit und Vertragswidrigkeit sind die Angaben des Herstellers der Ware.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">9.4 Die Gew&auml;hrleistungsfrist betr&auml;gt zw&ouml;lf Monate, falls keine anderslautende Frist auf den gelieferten Waren angezeigt ist. Sie beginnt mit dem Erhalt der Ware zu laufen. Die Bestimmungen in Abs. 9.2 bleiben von dieser Frist unber&uuml;hrt.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">9.5 Ist die Nacherf&uuml;llung im Wege der Ersatzlieferung erfolgt, dann ist der Besteller dazu verpflichtet, die zuerst gelieferte Ware innerhalb von 30 Tagen an den Onlineshop zur&uuml;ckzusenden. Die R&uuml;cksendung der mangelhaften Ware hat nach den gesetzlichen Vorschriften zu erfolgen. Der Onlineshop beh&auml;lt sich vor, unter den gesetzlich geregelten Voraussetzungen Schadensersatz geltend zu machen.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">9.6 Die Gew&auml;hrleistung erlischt in jedem Fall bei Eingriffen, Reparaturen oder Reparaturversuchen des K&auml;ufers oder nicht autorisierter Dritter, ohne unsere schriftliche Zustimmung.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">9.7 Sollten Transportsch&auml;den an der Ware festgestellt werden, bitten wir den Empf&auml;nger unverz&uuml;glich Schadensmeldung gegen&uuml;ber dem Frachtf&uuml;hrer (Versanddienst) zu machen. Sonstige erkennbare Transportsch&auml;den sind bitte innerhalb von 7 Tagen nach Erhalt der Ware uns gegen&uuml;ber schriftlich geltend zu machen. Die Vers&auml;umung dieser R&uuml;ge hat allerdings f&uuml;r Ihre gesetzlichen Anspr&uuml;che keine Konsequenzen.</span></p>
			<ol start="10">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Haftungsbeschr&auml;nkung</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">10.1 Schadensersatzanspr&uuml;che gegen uns sind ausgeschlossen, sofern sie nicht auf unserem vors&auml;tzlichem oder grob fahrl&auml;ssigem Verhalten oder dem unserer Erf&uuml;llungsgehilfen beruhen. Die Verj&auml;hrungsfrist f&uuml;r die Geltendmachung von Schadensersatz betr&auml;gt drei Jahre und beginnt mit dem Zeitpunkt, an dem die Schadensersatzverpflichtung ausl&ouml;sende Handlung begangen worden ist. Sollten die gesetzlichen Verj&auml;hrungsfristen im Einzelfall f&uuml;r uns zu einer k&uuml;rzeren Verj&auml;hrung f&uuml;hren, gelten diese. Die Haftung f&uuml;r Garantien erfolgt verschuldensunabh&auml;ngig.&nbsp;<br />F&uuml;r leichte Fahrl&auml;ssigkeit haftet die Beratungsfirma ausschlie&szlig;lich nach den Vorschriften des Produkthaftungsgesetzes, wegen der Verletzung des Lebens, des K&ouml;rpers oder der Gesundheit oder wegen der Verletzung wesentlicher Vertragspflichten. Der Schadensersatzanspruch f&uuml;r die leicht fahrl&auml;ssige Verletzung wesentlicher Vertragspflichten ist jedoch auf den vertragstypischen, vorhersehbaren Schaden begrenzt, soweit nicht wegen der Verletzung des Lebens, des K&ouml;rpers oder der Gesundheit gehaftet wird. F&uuml;r das Verschulden von Erf&uuml;llungsgehilfen und Vertretern haften wir in demselben Umfang.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">10.2 Die Regelung des vorstehenden Absatzes (10.1) erstreckt sich auf Schadensersatz neben der Leistung, den Schadensersatz statt der Leistung und den Ersatzanspruch wegen vergeblicher Aufwendungen, gleich aus welchem Rechtsgrund, einschlie&szlig;lich der Haftung wegen M&auml;ngeln, Verzugs oder Unm&ouml;glichkeit.</span></p>
			<ol start="11">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Datenschutz</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Der Kunde ist damit einverstanden, dass seine, dem Onlineshop im Rahmen der Gesch&auml;ftsbeziehung zugehenden pers&ouml;nlichen Daten, elektronisch gespeichert und verarbeitet werden. Es wird darauf hingewiesen, dass im Sinne dieser Bestimmung ermittelte Daten ausschlie&szlig;lich f&uuml;r Zwecke der Leistungserbringung, insbesondere zum Zweck der Auftragsabwicklung und der Buchhaltung erhoben und verarbeitet werden. Der Onlineshop gibt Kunden-Daten nicht an Dritte weiter. Die &Uuml;bermittlung der Daten erfolgt verschl&uuml;sselt. F&uuml;r die Sicherheit der im Internet &uuml;bermittelten Daten kann jedoch keine Haftung &uuml;bernommen werden.</span></p>
			<ol start="12">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Copyright</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Alle dargestellten Fremdlogos, Bilder und Grafiken sind Eigentum der entsprechenden Firmen und unterliegen dem Copyright der entsprechenden Lizenzgeber. S&auml;mtliche auf diesen Seiten dargestellten Fotos, Logos, Texte, Berichte, Scripte und Programmierroutinen, welche Eigenentwicklungen von uns sind oder von uns aufbereitet wurden, d&uuml;rfen nicht ohne unser Einverst&auml;ndnis kopiert oder anderweitig genutzt werden. Alle Rechte vorbehalten.</span></p>
			<ol start="13">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Gerichtsstand</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">12.1 Gerichtsstand ist, soweit das Gesetz nichts anders vorsieht, der Gesch&auml;ftssitz des Onlineshops.</span></p>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">12.2 F&uuml;r alle Streitigkeiten, die sich m&ouml;glicherweise aus diesem rechtlichen Verh&auml;ltnis ergeben, ist schweizerisches Recht unter Ausschluss der Kollisionsnormen anzuwenden. Die Anwendung von UN-Kaufrecht wird ausgeschlossen.</span></p>
			<ol start="14">
				<li><strong><span style="font-size: 11.0pt; font-family: Calibri;"> Salvatorische Klausel und G&uuml;ltigkeit der AGB</span></strong></li>
			</ol>
			<p><span style="font-size: 11.0pt; font-family: Calibri;">Mit einer Bestellung erkennt der Kunde die Allgemeinen Gesch&auml;ftsbedingungen des Onlineshops an. Sollte eine Bestimmung dieser Allgemeinen Gesch&auml;ftsbedingungen, aus welchem Grund auch immer, nichtig sein, bleibt die Geltung der &uuml;brigen Bestimmungen hiervon unber&uuml;hrt. Die unwirksame Regelung wird durch die einschl&auml;gige gesetzliche Regelung sofort ersetzt. M&uuml;ndliche Absprachen bed&uuml;rfen zu ihrer Wirksamkeit der schriftlichen Best&auml;tigung.</span></p>
		</div>
	</div>
</main>
@stop