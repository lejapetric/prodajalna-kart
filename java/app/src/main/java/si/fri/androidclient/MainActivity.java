package si.fri.androidclient;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    private TextView urlText;
    private User user;
    private View.OnClickListener logoutClickListener;
    private View.OnClickListener loginClickListener;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        CardREST.makeInstance(this);

        urlText = (TextView) findViewById(R.id.urlText);
        urlText.setText(CardREST.URL);

        Button viewCards = findViewById(R.id.store);
        Button profile = (Button) findViewById(R.id.profile);

        viewCards.setOnClickListener(view -> {
            CardREST.URL = urlText.getText().toString().trim();
            Intent intent = new Intent(this, BrowseCardsActivity.class);
            startActivity(intent);
        });

        profile.setOnClickListener(view -> {
            CardREST.URL = urlText.getText().toString().trim();

            Intent intent = new Intent(this, EditProfileActivity.class);
            intent.putExtra("user", JsonHelper.parser.toJson(user));
            startActivity(intent);
        });


        loginClickListener = (view -> {
            CardREST.URL = urlText.getText().toString().trim();
            TextView email = (TextView) findViewById(R.id.email);
            TextView password = (TextView) findViewById(R.id.password);
            Button loginButton = (Button) findViewById(R.id.loginButton);
            Button profileButton = (Button) findViewById(R.id.profile);

            //TODO retrieve user by logins
            user = new User();

            if (user != null) {
                email.setVisibility(View.INVISIBLE);
                password.setVisibility(View.INVISIBLE);
                loginButton.setText("Logout");
                loginButton.setOnClickListener(logoutClickListener);
                profileButton.setVisibility(View.VISIBLE);
            } else {
                Toast.makeText(getBaseContext(), "Invalid login, please try again.", Toast.LENGTH_LONG).show();
            }
        });

        logoutClickListener = (view -> {
            CardREST.URL = urlText.getText().toString().trim();
            TextView email = (TextView) findViewById(R.id.email);
            TextView password = (TextView) findViewById(R.id.password);
            Button loginButton = (Button) findViewById(R.id.loginButton);
            Button profileButton = (Button) findViewById(R.id.profile);

            email.setVisibility(View.VISIBLE);
            password.setVisibility(View.VISIBLE);
            loginButton.setText("Login");
            loginButton.setOnClickListener(loginClickListener);
            profileButton.setVisibility(View.INVISIBLE);
            user = null;

        });

        Button loginButton = findViewById(R.id.loginButton);
        loginButton.setOnClickListener(loginClickListener);
        profile.setVisibility(View.INVISIBLE);
    }
}