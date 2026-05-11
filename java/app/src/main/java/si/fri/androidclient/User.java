package si.fri.androidclient;

import com.google.gson.annotations.SerializedName;

public class User {

    @SerializedName(value = "id")
    public Integer id;

    @SerializedName(value = "ime")
    public String name;

    @SerializedName(value = "priimek")
    public String surname;

    @SerializedName(value = "naslov")
    public String address;

    @SerializedName(value = "email")
    public String email;

    @SerializedName(value = "geslo")
    public String password;  // Prejeli bomo hash iz PHP-ja

    @SerializedName(value = "tip")
    public String type;  // "buyer", "seller", "admin"

    // Prazni konstruktor za Gson
    public User() {}

    // Konstruktor za prijavo
    public User(String email, String password) {
        this.email = email;
        this.password = password;
    }

    @Override
    public String toString() {
        return name + " " + surname + " (" + email + ")";
    }
}