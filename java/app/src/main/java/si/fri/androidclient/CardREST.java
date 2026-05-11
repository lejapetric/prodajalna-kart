package si.fri.androidclient;

import android.content.Context;
import android.util.Log;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class CardREST {

    public static String URL = "http://10.0.2.2:8080/api/store";

    private static CardREST instance = null;
    private static RequestQueue queue;
    private static Context context;

    private Response.ErrorListener errorListener = new Response.ErrorListener() {
        @Override
        public void onErrorResponse(VolleyError error) {
            Log.e("CardREST", "Volley error: " + error.toString());
            error.printStackTrace();

            if (context != null) {
                Toast.makeText(context, "Error occurred: Network request failed", Toast.LENGTH_LONG).show();
            }
        }
    };

    private CardREST(Context context) {
        CardREST.context = context.getApplicationContext(); // Uporabite Application Context
        queue = Volley.newRequestQueue(CardREST.context);
        Log.d("CardREST", "CardREST instance created");
    }

    public void getAll(Response.Listener<JSONArray> listener) {
        Log.d("CardREST", "GET request to URL: " + URL);
        JsonArrayRequest request = new JsonArrayRequest(
                Request.Method.GET,
                URL,
                null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        Log.d("CardREST", "Response received, length: " + response.length());
                        listener.onResponse(response);
                    }
                },
                errorListener
        );
        queue.add(request);
    }

    public static void makeInstance(Context context1) {
        context = context1.getApplicationContext();
        if(instance == null) {
            instance = new CardREST(context1);
            Log.d("CardREST", "CardREST instance created via makeInstance");
        }
    }

    public static CardREST getInstance() {
        if (instance == null) {
            Log.e("CardREST", "CardREST not initialized! Call makeInstance first.");
            throw new IllegalStateException("CardREST not initialized. Call makeInstance() first.");
        }
        return instance;
    }
}