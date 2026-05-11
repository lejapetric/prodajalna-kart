package si.fri.androidclient;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.google.gson.reflect.TypeToken;

import java.lang.reflect.Type;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Base64;

public class EditProfileActivity extends AppCompatActivity {

    private User user;

    public EditProfileActivity() {

    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile_form);

        String userJson = getIntent().getStringExtra("user");
        user = JsonHelper.parser.fromJson(userJson, User.class);

        TextView profileName = findViewById(R.id.profileName);
        TextView profileSurname = findViewById(R.id.profileSurname);
        TextView profileEmail = findViewById(R.id.profileEmail);
        TextView profileAddress = findViewById(R.id.profileAddress);
        TextView profilePassword = findViewById(R.id.profilePassword);

        profileName.setText(user.name);
        profileSurname.setText(user.surname);
        profileEmail.setText(user.email);
        profileAddress.setText(user.address);

        Button saveButton = findViewById(R.id.profileSave);
        saveButton.setOnClickListener(view -> {
            User newUser = new User();
            newUser.name = profileName.getText().toString().trim();
            newUser.surname = profileSurname.getText().toString().trim();
            newUser.address = profileAddress.getText().toString().trim();
            newUser.email = profileEmail.getText().toString().trim();
            newUser.password = Base64.getEncoder().encodeToString(profilePassword.getText().toString().trim().getBytes(StandardCharsets.UTF_8));

            //TODO make rest call to update profile
        });

    }

}
