package si.fri.androidclient;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import java.util.List;

public class CardAdapter extends ArrayAdapter<Card> {

    public CardAdapter(@NonNull Context context, int resource, @NonNull List<Card> objects) {
        super(context, resource, objects);
        Log.d("DEBUG", "CardAdapter created with " + objects.size() + " items");
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View view = convertView == null ?
                LayoutInflater.from(getContext()).inflate(R.layout.card_element, parent, false) :
                convertView;

        Card card = getItem(position);

        if (card == null) {
            Log.e("DEBUG", "Card is NULL at position " + position);
            return view;
        }

        TextView title = view.findViewById(R.id.cardTitle);
        TextView author = view.findViewById(R.id.cardAuthor);
        TextView price = view.findViewById(R.id.cardPrice);

        if (title == null || author == null || price == null) {
            Log.e("DEBUG", "One of TextViews is NULL!");
            return view;
        }

        // Uporabite seller_email kot "prodajalca"
        title.setText(card.title != null ? card.title : "Brez naslova");
        author.setText(card.sellerEmail != null ? "Prodajalec: " + card.sellerEmail : "Neznan prodajalec");
        price.setText(card.price != null ? "€" + card.price : "€0.00");

        Log.d("DEBUG", "Setting card: " + card.title);

        return view;
    }
}