<div class="news-ticker">
    <div class="news-ticker-content" id="news-ticker-content">Φόρτωση ιατρικών ειδήσεων...</div>
</div>

<script src="js/jquery-3.7.1.min.js"></script>
<script>
    function fetchRSS() {
        $.ajax({
            url: 'https://api.rss2json.com/v1/api.json',
            method: 'GET',
            dataType: 'json',
            data: {
                rss_url: 'https://www.euro2day.gr/rss.ashx?chiid=899011', // RSS feed από το Skai.gr για ειδήσεις υγείας
                api_key: 'igtgdwgzrwnlib7gcuir381od8xswpbbgkalrj7l', // Βάλε εδώ το API Key σου
                count: 5 // Αριθμός ειδήσεων
            }
        }).done(function (data) {
            console.log("API Response:", data); // Έλεγχος απόκρισης
            
            if (data.status !== 'ok') {
                console.error('Σφάλμα από το API:', data.message);
                return;
            }

            const items = data.items;
            if (!items || items.length === 0) {
                console.error('Δεν βρέθηκαν ειδήσεις!');
                return;
            }

            let newsHtml = '';
            items.forEach(item => {
                newsHtml += `📰 <a href="${item.link}" target="_blank">${item.title}</a> | `;
            });

            // Ενημέρωση του ticker με τις ειδήσεις
            $('#news-ticker-content').html(newsHtml);

        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.error('Σφάλμα AJAX:', textStatus, errorThrown);
			console.error('Λεπτομέρειες:', jqXHR.responseText);
        });
    }


	
    $(document).ready(function () {
        fetchRSS(); // Φορτώνει τις ειδήσεις μόλις ανοίξει η σελίδα
        setInterval(fetchRSS, 60000); // Ανανεώνει τις ειδήσεις κάθε 60 δευτερόλεπτα
    });
</script>
