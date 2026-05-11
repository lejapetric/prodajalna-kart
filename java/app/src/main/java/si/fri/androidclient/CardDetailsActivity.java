package si.fri.androidclient;

import android.os.Bundle;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

public class CardDetailsActivity extends AppCompatActivity {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_card);

        String cardJson = getIntent().getStringExtra("card");
        Card card = JsonHelper.parser.fromJson(cardJson, Card.class);

        TextView cardTitle = findViewById(R.id.descCardTitle);
        TextView cardPrice = findViewById(R.id.descCardPrice);
        TextView cardSeller = findViewById(R.id.descCardAuthor);

        cardTitle.setText(card.title != null ? card.title : "Brez naslova");
        cardPrice.setText(card.price != null ? "€" + card.price : "€0.00");
        cardSeller.setText(card.sellerEmail != null ?
                "Prodajalec: " + card.sellerEmail : "Neznan prodajalec");
    }
}