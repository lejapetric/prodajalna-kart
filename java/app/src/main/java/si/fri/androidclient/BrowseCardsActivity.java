package si.fri.androidclient;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.widget.ListView;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Response;
import com.google.gson.reflect.TypeToken;

import org.json.JSONArray;

import java.lang.reflect.Type;
import java.util.ArrayList;
import java.util.List;

public class BrowseCardsActivity extends AppCompatActivity {

    private List<Card> cards;
    private List<Card> aktivneKarte;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cards);

        Log.d("DEBUG", "BrowseCardsActivity started");

        ListView listView = findViewById(R.id.items);

        CardREST.getInstance().getAll(new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                Log.d("DEBUG", "JSON Response received, length: " + response.length());

                // Debug: izpišemo prve 3 elemente
                try {
                    for (int i = 0; i < Math.min(response.length(), 3); i++) {
                        String cardStr = response.getJSONObject(i).toString();
                        Log.d("DEBUG", "Card " + i + ": " + cardStr);
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }

                Type type = new TypeToken<ArrayList<Card>>() {}.getType();
                cards = JsonHelper.parser.fromJson(response.toString(), type);

                if (cards == null) {
                    Log.e("DEBUG", "Parsing failed - cards is NULL!");
                    return;
                }

                Log.d("DEBUG", "Successfully parsed " + cards.size() + " cards");

                // FILTRIRANJE: samo aktivne karte (aktiviran == 1)
                aktivneKarte = new ArrayList<>();
                int aktivnih = 0;
                int neaktivnih = 0;

                for (Card card : cards) {
                    if (card.aktiviran != null && card.aktiviran == 1) {
                        aktivneKarte.add(card);
                        aktivnih++;
                    } else {
                        neaktivnih++;
                    }
                }

                Log.d("DEBUG", "Aktivnih kart: " + aktivnih + ", Neaktivnih: " + neaktivnih);
                Log.d("DEBUG", "Prikazujem " + aktivneKarte.size() + " aktivnih kart");

                // Debug prve aktivne karte
                if (!aktivneKarte.isEmpty()) {
                    Card firstCard = aktivneKarte.get(0);
                    Log.d("DEBUG", "Prva aktivna karta: " +
                            "ID=" + firstCard.id +
                            ", Title=" + firstCard.title +
                            ", Price=" + firstCard.price +
                            ", Seller=" + firstCard.sellerEmail +
                            ", Aktiviran=" + firstCard.aktiviran);
                }

                // Uporabite AKTIVNEKARTE namesto vseh kart
                CardAdapter adapter = new CardAdapter(
                        BrowseCardsActivity.this,
                        R.layout.card_element,
                        aktivneKarte  // <-- TU UPORABITE AKTIVNE KARTE
                );

                listView.setOnItemClickListener((parent, view, position, id) -> {
                    Card card = adapter.getItem(position);
                    if (card != null) {
                        Intent intent = new Intent(BrowseCardsActivity.this, CardDetailsActivity.class);
                        intent.putExtra("card", JsonHelper.parser.toJson(card));
                        startActivity(intent);
                    }
                });

                listView.setAdapter(adapter);
                Log.d("DEBUG", "Adapter set with " + adapter.getCount() + " aktivnih items");
            }
        });
    }

    // Opcijsko: dodajte metodo za osvežitev, če želite
    private void refreshCards() {
        // Tukaj lahko dodate kodo za osvežitev seznama
    }
}